<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.category.show',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parent_cats=Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.category.add',compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $category = new Category();
        $image = $req->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('category_photo'), $imageName);
        $category->title = $req->title;
        $category->summary = $req->summary;
        $category->is_parent = $req->is_parent;
        $category->parent_id = $req->parent_id;
        $category->photo =  $imageName;
        $category->status = $req->status;
        $category->save();
        return redirect()->route('category.index');
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
        $parent_cats=Category::where('is_parent',1)->get();
        $catEdit = Category::find($prodID);
        return view('backend.category.edit',compact('catEdit','parent_cats'));
        // $category=Category::findOrFail($id);
        // return view('backend.category.edit')->with('category',$category)->with('parent_cats',$parent_cats);
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
        $category_update = Category::find($id);
        $category_update->title=$req->title;
        $category_update->summary = $req->summary;
        $category_update->is_parent = $req->is_parent;
        $category_update->parent_id = $req->parent_id;
        // $category_update->description = $req->description;

        $category_update->status = $req->status;
        $old_photo = $req->input('old_photo');
        if (!empty($req->file('photo'))) {
            $image = $req->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('category_photo'), $imageName);
            $category_update->photo =  $imageName;
        } else {
            $category_update->photo = $old_photo;
        }

        $category_update->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        $status=$category->delete();
        if($status){
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting Category');
        }
        return redirect()->route('category.index');
    }

    public function getChildByParent(Request $request){

        $category=Category::findOrFail($request->id);
        $child_cat=Category::getChildByParentID($request->id);
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }
}
