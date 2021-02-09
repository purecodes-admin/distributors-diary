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
        ->get();
        return view('stock.inventory', ['data' => $inventories]);
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
        return view('stock.create', compact('customers','items'));
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
        return view('stock.edit',compact('inventory','items','customers'));
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

    public function RemainingStock(){
        // $items=Item::find($item);
        $inventories = Inventory::with('item')->where('distributor_id', auth()->user()->id)
        ->get();

        $inv = [];

        foreach ($inventories as $inventory) {
            $inv[$inventory->item_id] = $inventory;
            if($inventory->customer->category === 'supplier') {
                $prevStock = isset($inv[$inventory->item_id]['stock']) ?: 0;

                $inv[$inventory->item_id]['stock'] = $prevStock + $inventory->quantity;

            } else {
                $inv[$inventory->item_id]['stock'] = $prevStock - $inventory->quantity;;
            }

        }

        dd($inv);

        

        return view('stock.home', ['data' => $inventories]);
    }
}
