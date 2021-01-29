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
		return view('supplier', ['data' => supplier::where('category','supplier')->get()]);
    }
    public function index1()
	{
		return view('purchaser', ['data' => supplier::where('category','purchaser')->get()]);
    }
    
    public function addsupplier(Request $req)
    {
        $supplier= new supplier;
    	$supplier->name=$req->name;
        $supplier->address=$req->address;
        $supplier->email=$req->email;
    	$supplier->contact=$req->contact;
        $supplier->discription=$req->discription;
        $supplier->category=$req->category;
        $supplier->save();
        // return redirect('supplier');

    }

    public function index2()
	{
        //  Code for Getting Data From two Tables..
        
        $suppliers = DB::table('suppliers')->get(); 

        $items = DB::table('items')->get();
      
        return view('addinventory',compact('suppliers','items'));


    }

    public function edit($id)
	{

		$supplier=supplier::find($id);
		return view('edit',['supplier'=>$supplier]);
    }
    public function update(Request $req){
		
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
		return redirect('supplier');
    }
}
