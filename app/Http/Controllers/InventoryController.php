<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\supplier;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\InventoryController;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('inventory', ['data' => Inventory::all()]);

        $inventories = Inventory::with('item')->with('customer')->where('distributor_id', auth()->user()->id)
        ->paginate(5);
        return view('inventories.inventory', ['data' => $inventories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  Code for Getting Data From two Tables..
         
        $suppliers = DB::table('suppliers')->get();
        $customers = supplier::query();
        if(request()->get('category')) {
            $customers->where('category', request()->get('category'));
        } else {
            $customers->where('category', 'do-not-exist');
        }

        $customers = $customers->where('distributor_id', auth()->user()->id)->get();
        $items = DB::table('items')->where('distributor_id', auth()->user()->id)->get();
        return view('inventories.create', compact('customers','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory= new Inventory;
        $inventory->distributor_id=$request->user()->id;
    	$inventory->item_id=$request->item_id;
        $inventory->customer_id=$request->customer_id;
    	$inventory->quantity=$request->quantity;
        $inventory->price=$request->price;
        $inventory->save();

        if($inventory->customer->category === 'supplier'){
            DB::table('items')->where('id',$inventory->item_id)
            ->where('distributor_id',$request->user()->id)
            ->increment('stock',$inventory->quantity)
            ;
        } 
        else 
        {
            DB::table('items')->where('id',$inventory->item_id)
            ->where('distributor_id',$request->user()->id)
            ->decrement('stock',$inventory->quantity);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {        
        $items = DB::table('items')->where('distributor_id', auth()->user()->id)->get();
        $suppliers = DB::table('suppliers')->get();
        $c = supplier::query();

        if(request()->get('category')) {
            $c->where('category', request()->get('category'));
        }
        $c->where('distributor_id', auth()->user()->id);
        $customers = $c->get();
        if(Gate::allows('update-customer',$inventory)){
        return view('inventories.edit',compact('inventory','items','customers'));
        }
        else{
            return'You are not Owner of This Record....!!!';
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inventory=Inventory::find($request->id);
    	$inventory->item_id=$request->item_id;
        $inventory->customer_id=$request->customer_id;
    	$inventory->quantity=$request->quantity;
        $inventory->price=$request->price;
        $inventory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        if(Gate::allows('update-customer',$inventory)){
        $inventory->delete();
        }
        else{
            return'You Are Not The Owner of This Inventory....!!!';
        }
    }
}
