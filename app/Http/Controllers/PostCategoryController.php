<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\POSTCategory;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p_category = PostCategory::all();
        return view('backend.postcategory.show',compact('p_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.postcategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $p_category = new PostCategory();
        $p_category ->title = $req->title;
        $p_category ->status = $req->status;
        $p_category ->save();
        return redirect()->route('postcategory.index');
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
        $prodID = Crypt::decrypt($id);
        $pEdit = PostCategory::find($prodID);
        return view('backend.postcategory.edit',compact('pEdit'));
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
        {
            $pcat_update = PostCategory::find($id);
            $pcat_update->title=$req->title;
            $pcat_update->status = $req->status;
            $pcat_update->save();
            return redirect()->route('postcategory.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p_category=PostCategory::findOrFail($id);
        $status=$p_category->delete();
        if($status){
            request()->session()->flash('success','Brand successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting brand');
        }
        return redirect()->route('postcategory.index');
    }
}
