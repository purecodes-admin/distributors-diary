<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
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

            $tags= Tag::where('distributor_id',auth()->user()->id)
            ->orWhereNull('distributor_id')->get();

        $expense = Expense::with('tags')->where('distributor_id',auth()->user()->id)
        ->when($from, function($query) use ($from) {
            $query->where('date', '>=', $from);
        })
        ->when($to, function($query) use ($to) {
            $query->where('date', '<=', $to);
        })
        ->when(request('tag_type'), function($q) {
            $q->whereHas('tags', function($q) {
                $q->whereIn('tags.id', request('tag_type'));
            });
        })
        
        ->paginate(5);
        // print_r($expense);
        // return($expense);
        if(Gate::allows('distributor-only')){
        return view('users.expenses', ['data' => $expense , 'tags'=>$tags]);
        }
        else{
            return response()->json(['message' => 'Forbidden!'], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = DB::table('tags')->where('distributor_id',auth()->user()->id)
        ->orWhereNull('distributor_id')
        ->get();
        if(Gate::allows('distributor-only')){
            return view('users.create-expenses', compact('tags'));
        }
        else{
            return response()->json(['message' => 'Forbidden!'], 403);
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
        $date=now();

        $expense= new Expense;
        $expense->expense_amount= $request->expense_amount;
        // $expense->tags= $request->tags;
        $expense->date= $date;
        $expense->distributor_id=$request->user()->id;

        $expense->save();
        $expense->tags()->attach($request->tags);
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
