<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        //auth()->login($user);
        auth('web')->login($user);
        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        //auth()->logout();
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth('web')->attempt($formFields)) {
    $request->session()->regenerate();
    return redirect('/')->with('message', 'You are now logged in!');
}

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
/*class UserController extends Controller
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
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }
}
*/