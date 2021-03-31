<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\supplier;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
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

        $items = Item::where('distributor_id',auth()->user()->id)
            ->when(request('search') != '', function($q) {
                $q->where('name', 'like', '%' . request('search') . '%');
            })
            ->paginate(5);
            if(Gate::allows('distributor-only')){
                    return view('items.items', ['data' => $items ]);
            }
            else{
                return"405! Method Not Allowed!";
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('distributor-only')){
            return view('items.store');
        }
        else{
            return"405! Method Not Allowed";
        }
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
    	$item->wholesale_price=$request->wholesale_price;
    	$item->retailsale_price=$request->retailsale_price;
        $item->stock=0;
        $item->total_money=0;
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
        $item->wholesale_price=$request->wholesale_price;
        $item->retailsale_price=$request->retailsale_price;
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
        
        if ( !Gate::allows('update-customer', $item)) {
        return'You are Not Eligible';
        }

        try
        {
            // throw new \Exception('item not Deleted');
        $item->delete();
        Session::flash('message', 'Item Deleted Successfully!');  
        return redirect('items');
    }
    catch(exception $e){

        Session::flash('error', 'Item Not Deleted!'); 
        return redirect('items');

    }
    
    }



    public function RemainingStock()
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $items = [] ;

         $inventories = Inventory::with('item')->with('customer')->where('distributor_id',auth()->user()->id)
        ->get();


        foreach($inventories as $inventory) { 
            if($inventory->customer->category !== 'purchaser') {
                continue;
            }

            if(array_key_exists($inventory->item->id, $items)) {
                $items[$inventory->item->id]['price'] += $inventory->price;
                continue;    
            }

            $items[$inventory->item->id] = ['name' => $inventory->item->name, 'price' => $inventory->price];

        }
        // return $items;
        // Declare an empty array variable
        // loop over inventories
        // ignore if customer category isn't purchaser  
        // Check if item already added to array variable
            // if it's already added, add price to previous entry in the array
            // if it's not already added, add new entry in the array variable
        // Pass array variable to view

        // name of the item, sum of the prices within chosen duration



        // payment pending code and remaining stock code view on same page two view together
        // you can pass more than 1 variable in array like in this function e.g dues and data
        
        if(Gate::allows('distributor-only')){

            $date = \Carbon\Carbon::today()->subDays(7);

            $payment = supplier::where('distributor_id', auth()->user()->id)
            ->where('dues', '!=' , 0)
                ->orderBy('dues','desc')
                ->get();

        return view('items.home', [
            'data' => Item::where('distributor_id',auth()->user()->id)
            ->orderBy('stock','asc')
            ->get(),

            
            'inventory' => $items,
            'dues' => $payment,

            ]);
        }
        else{
            return"405! Method Not Allowed!";
        }
    }

    // Timeline of an item code

    public function timeline(Item $item)
    {  
        $inventories = Inventory::with('item')->with('customer')->with('user')->where('distributor_id', auth()->user()->id)
        ->where('item_id',$item->id)
        ->paginate(5);

        if(!$inventories->isEmpty()){
            if(Gate::allows('distributor-only')){
              return view('items.timeline', ['data' => $inventories]);
            }
            else{
                return"405! Method Not Allowed";
            }
        }
        else{
            if(Gate::allows('distributor-only')){
             return view('items.timeline', ['data' => $inventories]);
            }
            else{
                return"405! Method Not Allowed";
            
        }
        }
    }
}