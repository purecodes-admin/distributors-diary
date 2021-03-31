<?php

namespace App\Http\Controllers;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\MySqlConnection;
use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Session;

class supplierController extends Controller
{

// View Customers code

    public function index(Request $request)
	{
        $customers=supplier::where('distributor_id',auth()->user()->id)
        ->when(request('search') !='', function($query){
            $query->where('name','like','%'.request('search').'%');
        })
            // code for drop down to select type
        ->when(request('customer_type') != '', function($q) {
            if(request('customer_type') == 'suppliers') {
                $q->where('category','supplier');
            } else {
                $q->where('category','purchaser');
            }
        })

        ->paginate(3);
        if(Gate::allows('distributor-only')){
		return view('customers.customers', ['data' => $customers ]);
        }
        else{
            return"405! Method Not Allowed!"; 
        }
    }

    // View suppliers code


    public function suppliers()
	{
         if(Gate::allows('distributor-only')){
		return view('customers.supplier', ['data' => supplier::where('category','supplier')->where('distributor_id',auth()->user()->id)->paginate(3)]);
         }
         else{
            return"405! Method Not Allowed!"; 
        }
    }


    // View purchasers code

    public function purchasers()
	{
        if(Gate::allows('distributor-only')){
		return view('customers.purchaser', ['data' => supplier::where('category','purchaser')->where('distributor_id',auth()->user()->id)->paginate(3)]);
        }
        else{
            return"405! Method Not Allowed!"; 
        }
    }

    // Add Customer Form Code

    public function create(){

        if(Gate::allows('distributor-only')){
            return view('customers.add');
        }
        else{
            return"405! Method Not Allowed!";
        }
    }
    
    // Add Customer Code

    public function add(Request $req)
    {
        $supplier= new supplier;
    	$supplier->distributor_id=$req->user()->id;
    	$supplier->name=$req->name;
        $supplier->address=$req->address;
        $supplier->email=$req->email;
    	$supplier->contact=$req->contact;
        $supplier->discription=$req->discription;
        $supplier->category=$req->category;
        $supplier->dues=0;
        $supplier->save();

    }

// Edit Customer Code

    public function edit(supplier $supplier)
	{
        if ( Gate::allows('update-customer', $supplier)) {
        return view('customers.edit',['supplier'=>$supplier]);
        }
        else{
            return'You are Unauthorized for this Record....!!!';
        }
    }
    
    // Update Customer Code

    public function update(Request $req)
    {
		$supplier=supplier::find($req->id);
        $supplier->name=$req->name;
        $supplier->address=$req->address;
        $supplier->email=$req->email;
    	$supplier->contact=$req->contact;
        $supplier->discription=$req->discription;
        $supplier->save();
    }

    // Delete Customer Code

    public function delete(supplier $supplier)
	{
		if(!Gate::allows('update-customer',$supplier)){
            return'You are Unauthorized for this Record....!!!';
        }
        try{
        $supplier->delete();
        Session::flash('message', 'Customer Deleted Successfully!');  
        return redirect('customers');
        }
        catch(exception $e){
        Session::flash('error', 'Customer Not Deleted!');  
        return redirect('customers');

    }
   
   }
    
}
