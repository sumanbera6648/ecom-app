<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function index(){
        return view('users.index');
    }
    public function profile(){
        $profile = Auth()->user();
        $country = Country::all();

        return view('users.pages.profile',compact('profile','country'));
    }

    public function profile_update(Request $req){
        $profile_update = User::find($req->id);
        $profile_update->name = $req->name;
        $profile_update->email = $req->email;
        $profile_update->phone = $req->phone;
        $profile_update->post_code = $req->post_code;
        $profile_update->address = $req->address;
        $profile_update->city = $req->city;
        $profile_update->country_id = $req->country_id;
        $profile_update->state_id = $req->state_id;
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
        return redirect()->route('user_profile');
    }
    public function getState($id) {
        $states = State::where('country_id',$id)->pluck('name','id');
        return json_decode($states);
    }

    public function my_order(){

        return view('users.pages.myorder');
    }




}
