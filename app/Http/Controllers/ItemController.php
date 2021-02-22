<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\supplier;
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
    	$item->price=$request->price;
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
        $item->price=$request->price;
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
        // payment pending code and remaining stock code view on same page
        // you can pass more than 1 variable in array like in this function e.g dues and data
        
        if(Gate::allows('distributor-only')){

            $payment = supplier::where('distributor_id', auth()->user()->id)
                ->orderBy('dues','desc')
                ->paginate(5);

        return view('items.home', [
            'data' => Item::where('distributor_id',auth()->user()->id)->paginate(5),
            'dues' => $payment
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


// Method To call a Function in a Function to display 2 or more querries E.g in RemainingStock function
// protected function dues()
// {  
//     return Inventory::with('item')->with('customer')
//     ->where('distributor_id', auth()->user()->id)
//     ->whereNull('payment')
//     ->orderBy('price','desc')
//     ->paginate(5);
// }


}







// if($inventory->customer->category === 'supplier'){
//     DB::table('suppliers')->where('id',$inventory->customer_id)
//     ->where('distributor_id',$request->user()->id)
//     ->add('price',$inventory->price)
//     ;
// } 
// else 
// {
//     DB::table('items')->where('id',$inventory->item_id)
//     ->where('distributor_id',$request->user()->id)
//     ->decrement('stock',$inventory->quantity);
// }