<?php

namespace App\Http\Controllers;

use App\Models\PostTag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p_tag = PostTag::all();
        return view('backend.posttag.show',compact('p_tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posttag.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $p_tag = new PostTag();
        $p_tag ->title = $req->title;
        $p_tag ->status = $req->status;
        $p_tag ->save();
        return redirect()->route('posttag.index');
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
        $tagEdit = PostTag::find($id);
        return view('backend.posttag.edit',compact('tagEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
            $pcat_update = PostTag::find($id);
            $pcat_update->title=$req->title;
            $pcat_update->status = $req->status;
            $pcat_update->save();
            return redirect()->route('posttag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p_category=PostTag::findOrFail($id);
        $status=$p_category->delete();
        if($status){
            request()->session()->flash('success','Brand successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting brand');
        }
        return redirect()->route('posttag.index');
    }
}
