<?php

namespace App\Http\Controllers;
use App\Models\supplier;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
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

        return view('inventory', ['data' => Inventory::all()]);

            // $inventories = Inventory::with('item')->get();
            // $suppliers= supplier::find(1);
            // $inventories = $suppliers->inventrable;
            // return view('inventory',['data'=>$inventories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new Inventory;

            $user->inventories()->create([
            'item_id' => $request->body,
            'quantity'=> $request->quantity,
            'price'=> $request->price,
        ]);
        // $inventory= new Inventory;
    	// $inventory->item_id=$request->item_id;
        // $inventory->inventrable_type=$request->category;
        // $inventory->inventrable_id=$request->customer_id;
    	// $inventory->quantity=$request->quantity;
        // $inventory->price=$request->price;
        // $inventory->save();
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
    public function edit($id)
    {
        $inventory=Inventory::find($id);
        // return view('editstock',['inventory'=>$inventory]);

        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
      
        return view('editinventory',compact('inventory','items','suppliers'));
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
        $inventory->inventrable_type=$request->category;
        $inventory->inventrable_id=$request->customer_id;
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
    public function destroy($id)
    {
        $inventory=Inventory::find($id);
        $inventory->delete();
    }
}
