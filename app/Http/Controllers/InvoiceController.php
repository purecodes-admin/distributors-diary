<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

// for indiviual user invoice personally
    public function index(Request $request)
    {

            $from=$request->searchFrom;
            $to=$request->searchTo;

            $invoices = Invoice::with('distributor')->where('distributor_id', auth()->user()->id)
            ->when($from, function($query) use ($from) {
                $query->where('month', '>=', $from);
            })
            ->when($to, function($query) use ($to) {
                $query->where('month', '<=', $to);
            })
            ->paginate(5);
            return view('users.user-invoices',['data'=>$invoices]);

    }


    // for admin to show whole invoices
    
    public function ShowInvoices(Request $request)
    {

        $from=$request->searchFrom;
        $to=$request->searchTo;

     // Getting Distributor ids and convert them into search name
        $distributorIDs = User::where('name', 'like', '%' . request('search') . '%')
        ->where('set_as', 0)->pluck('id')->toArray();


        $invoices = Invoice::with('distributor')->whereIn('distributor_id', $distributorIDs)
        ->when($from, function($query) use ($from) {
            $query->where('month', '>=', $from);
        })
        ->when($to, function($query) use ($to) {
            $query->where('month', '<=', $to);
        })

        // The function use in when clause is an anonymous function(php function) 
        // and $q is a closure... i have to learn what are they and how they are working....
        
        ->when(request('invoice_type') != '', function($q) {
            if(request('invoice_type') == 'paid') {
                $q->whereNotNull('has_paid');
            } else {
                $q->whereNull('has_paid');
            }
        })
        ->paginate(5);
        return view('users.show-invoices',['data'=>$invoices]);

    }

    // for paid invoices
    public function PaidInvoices()
    {
        $invoices = Invoice::with('distributor')
        ->whereNotNull('has_paid')
        ->paginate(5);
        return view('users.paid_invoices',['data'=>$invoices]);

    }

    public function UnpaidInvoices()
    {
        $invoices = Invoice::with('distributor')
        ->whereNull('has_paid')
        ->paginate(5);
        return view('users.paid_invoices',['data'=>$invoices]);

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
        //
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
}
