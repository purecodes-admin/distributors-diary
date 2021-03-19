<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        if(Gate::allows('admin-only')){
          return view('users.admin-tags', ['data' => $tags ]);
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
        if(Gate::allows('admin-only')){
        return view('users.create-tags');
        }
        else{
            return response()->json( 403);
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
        $request->validate([

            'slug'=> 'unique',
        ]);
        

        if(Tag::whereSlug(Str::slug($request->label))->exists()) {
            return response()->json(['message' => 'This Label Already Exists!'], 422);
         }
        $tag= new Tag;
        $tag->label= $request->label;
        $tag->slug= Str::slug($tag->label);
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
    public function destroy(Tag $tags)
    {
        $tag=Tag::find($tags);
		$tag->each->delete();
    }



    public function CustomTag()
    {
        if(Gate::allows('distributor-only')){
        return view('users.create-own-tags');
        }
        else{
            return response()->json(['message' => 'Forbidden!'], 403);
        }    
    }



    public function AddCustomTag( Request $request)
    {
       

        if(Tag::whereSlug(Str::slug($request->label))->exists()) {
            return response()->json(['message' => 'This Label Already Exists!'], 422);
         }
         $tag= new Tag;
        $tag->label= $request->label;
        $tag->slug= Str::slug($tag->label);
        $tag->distributor_id=$request->user()->id;
        $tag->save();
    }


    public function DistributorsTags()
    {
        $tags = Tag::where('distributor_id', auth()->user()->id)->orWhereNull('distributor_id')->when(request('search') != '', function($q) {
            $q->where('label', 'like', '%' . request('search') . '%');
        })
        ->paginate(5);
        if(Gate::allows('distributor-only')){
        return view('users.distributors-tags', ['data' => $tags ]);
        }
        else{
            return response()->json(['message' => 'Forbidden!'], 403);
        }    

    }

    

    public function DeleteDistributorTag(Tag $tags)
    {
        $tag=Tag::find($tags)->where('distributor_id',auth()->user()->id);
		$tag->each->delete();

    }
}
