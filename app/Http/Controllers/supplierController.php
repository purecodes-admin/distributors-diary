<?php

namespace App\Http\Controllers;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\MySqlConnection;
use App\Http\Controllers\supplierController;

class supplierController extends Controller
{


    public function index()
	{
		return view('customers.customers', ['data' => supplier::where('distributor_id',auth()->user()->id)->paginate(3)]);
    }
    public function suppliers()
	{
		return view('customers.supplier', ['data' => supplier::where('category','supplier')->where('distributor_id',auth()->user()->id)->paginate(3)]);
    }
    public function purchasers()
	{
		return view('customers.purchaser', ['data' => supplier::where('category','purchaser')->where('distributor_id',auth()->user()->id)->paginate(3)]);
    }
    
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
        $supplier->save();

    }


    public function edit(supplier $supplier)
	{
        if ( Gate::allows('update-customer', $supplier)) {
        return view('customers.edit',['supplier'=>$supplier]);
        }
        else{
            return'You are Unauthorized for this Record....!!!';
        }
    }
    
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

    public function delete(supplier $supplier)
	{
		if(Gate::allows('update-customer',$supplier)){
        $supplier->delete();
    }
    else
    {
        return'You are Unauthorized for this Record....!!!';
    }
    }
    public function search(Request $req)
	{
        $search= $req->get('search');
        $customers=DB::table('suppliers')->where('name','LIKE','%'.$search.'%')->where('distributor_id',auth()->user()->id)
        ->get();
        return view('customers.search',['customers'=>$customers]);
    }
}
