<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::All();
        return view('backend.post.show',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('backend.post.add',compact('categories','tags','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $post = new Post();
        $image = $req->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('post_photo'), $imageName);
        $post->title = $req->title;
        $post->quote = $req->quote;
        $post->summary = $req->summary;
        $post->description = $req->description;
        $post->post_cat_id = $req->post_cat_id;
        // $post->tags = $req->tags;
        $tags = $req->input('tags');
        if ($tags) {
            $post['tags'] = implode(',', $tags);
        } else {
            $post['tags'] = '';
        }
        $post->added_by = $req->added_by;
        $post->photo =  $imageName;
        $post->status = $req->status;
        $post->save();
        return redirect()->route('post.index');
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
        $post=Post::findOrFail($id);
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('backend.post.edit',compact('categories', 'tags', 'users','post'));
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
        
            $post_update = Post::find($id);
            $post_update->title = $req->title;
            $post_update->quote = $req->quote;
            $post_update->summary = $req->summary;
            $post_update->description = $req->description;
            $post_update->post_cat_id = $req->post_cat_id;
            $old_photo = $req->input('old_photo');
            if (!empty($req->file('photo'))) {
                $banner = $req->file('photo');
                $bannerName = time() . '.' . $banner->getClientOriginalName();
                $banner->move(public_path('post_photo'), $bannerName);
                $post_update->photo =  $bannerName;
            } else {
                $post_update->photo = "$old_photo";
            }
            // $post->tags = $req->tags;
            $tags = $req->input('tags');
            if ($tags) {
                $post_update['tags'] = implode(',', $tags);
            } else {
                $post_update['tags'] = '';
            }
            $post_update->added_by = $req->added_by;
            // $post_update->photo =  $imageName;
            $post_update->status = $req->status;
            $post_update->save();
            return redirect()->route('post.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $status=$post->delete();
        if($status){
            request()->session()->flash('success','Brand successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting brand');
        }
        return redirect()->route('post.index');
    }
}
