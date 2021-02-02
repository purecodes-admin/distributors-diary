<?php

namespace App\Http\Controllers;
use Illuminate\support\Facades\DB;
use App\Models\supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\supplierController;

class supplierController extends Controller
{


    public function index()
	{
		return view('customer.customers', ['data' => supplier::where('distributor_id',auth()->user()->id)->get()]);
    }
    public function suppliers()
	{
		return view('customer.supplier', ['data' => supplier::where('category','supplier')->where('distributor_id',auth()->user()->id)->get()]);
    }
    public function purchasers()
	{
		return view('customer.purchaser', ['data' => supplier::where('category','purchaser')->where('distributor_id',auth()->user()->id)->get()]);
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

    public function edit($id)
	{

		$supplier=supplier::find($id);
		return view('customer.edit',['supplier'=>$supplier]);
    }
    public function update(Request $req)
    {
		
		$supplier=supplier::find($req->id);
        $supplier->name=$req->name;
        $supplier->address=$req->address;
        $supplier->email=$req->email;
    	$supplier->contact=$req->contact;
        $supplier->discription=$req->discription;
        $supplier->category=$req->category;
        $supplier->save();

        return response()->json(['success' => true]);

    }
    public function delete($id)
	{
		$supplier=supplier::find($id);
        $supplier->delete();
    }
}
