<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    //show register create form
    public function create(){
        return view('users.register');
    }
    //create new users
    public function store(Request $request){
     $formFields = $request->validate([
         'name' => 'required|max:255',
         'email' => 'required|email|max:255|unique:users',
         'password' => 'required|min:6|confirmed',
     ]);
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        $user =User::create($formFields);
        //login
        Auth::login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }
    //logout user
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }
    //show login form
    public function login(){
        return view('users.login');
    }
    //authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //attempt to authenticate user
        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
