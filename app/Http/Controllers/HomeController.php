<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.dashboard');
    }
    public function profile(){
        $profile = Auth()->user();
        return view('backend.user.profile',compact('profile'));
    }


    public function profile_update(Request $req){
        $profile_update = User::find($req->id);
        $profile_update->name = $req->name;
        $profile_update->email = $req->email;
        $profile_update->phone = $req->phone;
        $profile_update->country = $req->country;
        $profile_update->post_code = $req->post_code;
        $profile_update->address = $req->address;
        $old_photo = $req->input('old_photo');
        if (!empty($req->file('photo'))) {
            $profileimage = $req->file('photo');
            $profileName = time() . '.' . $profileimage->getClientOriginalName();
            $profileimage->move(public_path('profile_photo'), $profileName);
            $profile_update->photo = $profileName;
        } else {
            $profile_update->photo =  $old_photo;
        }$old_photo = $req->input('old_photo');

        $profile_update->save();
        return redirect()->route('admin_profile');
    }

    // public function login(){
    //     return view('backend.auth.login');
    // }

    // public function login_submit(Request $request){
    //     $data= $request->all();
    //     if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
    //         Session::put('admin',$data['email']);
    //         request()->session()->flash('success','Successfully login');
    //         return redirect()->route('home');
    //     }
    //     else{
    //         request()->session()->flash('error','Invalid email and password pleas try again!');
    //         return redirect()->back();
    //     }
    // }


}
