<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banner'] = Banner::all();
        return view('backend.banner.show',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
            $courses = new Banner();
            $banner = $req->file('photo');
            $bannerName = time() . '.' . $banner->getClientOriginalName();
            $banner->move(public_path('banner_photo'), $bannerName);
            $courses->title = $req->title;
            $courses->photo =  $bannerName;
            $courses->description = $req->description;
            $courses->status = $req->status;

            $courses->save();
            return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $bannerEdit = Banner::find($prodID);
        // dd($bannerEdit);
        return view('backend.banner.edit',compact('bannerEdit'));
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
        $banner_update   = Banner::find($id);
        $banner_update->title=$req->title;
        $banner_update->description = $req->description;
        $banner_update->status = $req->status;
        $old_photo = $req->input('old_photo');
        if (!empty($req->file('photo'))) {
            $banner = $req->file('photo');
            $bannerName = time() . '.' . $banner->getClientOriginalName();
            $banner->move(public_path('banner_photo'), $bannerName);
            $banner_update->photo =  $bannerName;
        } else {
            $banner_update->photo = "$old_photo";
        }

        $banner_update->save();
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::findOrFail($id);
        $status=$banner->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
