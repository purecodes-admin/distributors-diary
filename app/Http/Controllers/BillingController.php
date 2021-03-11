<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App;
use PDF;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $from=$request->searchFrom;
        $to=$request->searchTo;

        // dd($to);

        $distributorIDs = User::where('name', 'like', '%' . request('search') . '%')
        ->where('set_as', 0)->pluck('id')->toArray();
        

        $billings = Billing::with('user')->whereIn('distributor_id', $distributorIDs)
        ->when($from, function($query) use ($from) {
            $query->where('date', '>=', $from);
        })
        ->when($to, function($query) use ($to) {
            $query->where('date', '<=', $to);
        })
        ->paginate(5);
        return view('users.admin-billing', ['data' => $billings]);
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

        $user= new Billing;
        $user->admin_id = $request->user()->id;
        $user->distributor_id = $request->id;
        $user->payment = $request->payment;
        $user->mode = $request->mode;
        $user->date = $request->date;
        $user->save();  

        DB::table('users')->where('id',$user->distributor_id)
        ->decrement('payment',$user->payment)
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.fee',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function UserBilling(){

        $billings = Billing::with('user')
        ->where('distributor_id', Auth::user()->id)
        ->paginate(4);
        return view('users.billing', ['data' => $billings]);

     }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function BillInvoice()
    {
        // $pdf = App:: make('dompdf.wrapper');
        // $pdf->LoadHtml('<h1>Header Without Style</h1>');
        // return $pdf->stream();
        $billings = Billing::with('user')->where('distributor_id',5)
        ->get();

            $pdf = PDF::loadView('users.bill-invoice',['data' => $billings]);
            // return $pdf->download('invoice.pdf');
            return $pdf->stream();
    }
}
