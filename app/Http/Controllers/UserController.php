<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Go to the model and get a group of records
        $users = User::orderBy('id', 'asc')->paginate(10);

        // return the view and pass it to the view to be looped through
        return view('user.index')->with('users', $users);
    }

    public function edit() {
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);

            if ($user) {
                return view('user.edit')->withUser($user);
            } else {
                return redirect()->back();
            }            
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);
        $validate = null;

            if ($user) {

                if (Auth::user()->email === $request['email']) {
                    $validate = $request->validate([
                        'name' => 'required|min:2',
                        'email' => 'required|email'
                    ]);
                } else {
                    $validate = $request->validate([
                        'name' => 'required|min:2',
                        'email' => 'required|email|unique:users'
                    ]);
                }
                
                if($validate) {
                    $user->name = $request['name'];
                    $user->email = $request['email'];
                    $user->save();
                    add2Log('User updated details.');
                    return redirect()->route('user.profile', Auth::user()->id)->with('success' , 'Details updated successfully');
                } else {
                    return redirect()->route('edit.user')->with('error' , 'Error updating Details');
            }
        }
    }

    public function passwordEdit()
    {
        if(Auth::user()) {
            return view('user.password');
            } else {
                return redirect()->back();
        }            
    }
    

    public function passwordUpdate(Request $request) 
    {
        $validate = $request->validate([
            'oldPassword' => 'required|min:7',
            'password' => 'required|min:7|required_with:password_confirmation',
            'password_confirmation' => 'required|min:7'
        ]);

        $user = User::find(Auth::user()->id);

        if($user) {
            if (Hash::check($request['oldPassword'], $user->password) && $validate) {
                $user->password = Hash::make($request['password']);
                $user->save();
                add2Log('User updated password.');
                return redirect()->route('user.profile', Auth::user()->id)->with('success' , 'Password updated successfully');
            } else {
                return redirect()->route('password.edit')->with('error' , 'Password does not match current password');
            }
        }
    }

    public function profile($id) 
    {
        $user = User::find($id);
        if($user) {
            return view('user.profile')->withUser($user);
        } else {
            return redirect()->back();
        }
    }
}
