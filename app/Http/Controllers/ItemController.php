<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ItemController;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return view('items.items', ['data' => Item::where('distributor_id',auth()->user()->id)->paginate(5)]);
            // $data=Item::paginate(5);
            // return view('item.items',['data'=>$data]);
        }
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
        $item= new Item;
        $item->distributor_id=$request->user()->id;
    	$item->name=$request->name;
        $item->stock=0;
        $item->save();
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
    public function edit(Item $item)
    {
        
        if ( Gate::allows('update-customer', $item)) {
        return view('items.edit',['item'=>$item]);
    }
    else{
        return'You are Not Eligible';
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
        $item=Item::find($request->id);
        $item->name=$request->name;
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if ( Gate::allows('update-customer', $item)) {
        $item->delete();
    }
    else{
        return'You are Not Eligible';
    }
    }

    public function RemainingStock()
    {
        return view('items.home', ['data' => Item::where('distributor_id',auth()->user()->id)
        ->paginate(5)]);
    }

    public function timeline(Item $item)
    {  
        $inventories = Inventory::with('item')->with('customer')->with('user')->where('distributor_id', auth()->user()->id)
        ->where('item_id',$item->id)
        ->paginate(5);
        if(!$inventories->isEmpty()){
        return view('items.timeline', ['data' => $inventories]);
        }
        else{
            return view('items.timeline', ['data' => $inventories]);
        }
        }

}
