<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::when(request('search') != '', function($q) {
            $q->where('label', 'like', '%' . request('search') . '%');
        })
        ->paginate(5);
        return view('users.admin-tags', ['data' => $tags ]);
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create-tags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tag= new Tag;

        if(Tag::whereSlug(Str::slug($tag->label))->exists()) {
            return "This Tags is Already Exist"; 
         }

        $tag->label= $request->label;
        $tag->slug= Str::slug($tag->label);
        $tag->has_global= 1;
        $tag->distributor_id=$request->user()->id;
        $tag->save();
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
    public function destroy(Tag $tag)
    {
        if ( Gate::allows('admin-only', $tag)) {
            $tag->delete();
        }
        else{
            return'You are Not Eligible';
        }
    }



    public function CustomTag()
    {
        return view('users.create-own-tags');
    }



    public function AddCustomTag( Request $request)
    {
        $tag= new Tag;

        if(Tag::whereSlug(Str::slug($tag->label))->exists()) {
            return "This Tags is Already Exist"; 
         }

        $tag->label= $request->label;
        $tag->slug= Str::slug($tag->label);
        $tag->has_global= 1;
        $tag->distributor_id=$request->user()->id;
        $tag->save();
    }


    public function DistributorsTags()
    {
        $tags = Tag::when(request('search') != '', function($q) {
            $q->where('label', 'like', '%' . request('search') . '%');
        })
        ->paginate(5);
        return view('users.distributors-tags', ['data' => $tags ]);

    }
}
