<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class LoginRegistrationController extends Controller
{

   public function __construct(){
    $this->middleware('guest')->except([
        'logout','dashboard'
    ]);
   }

   public function register(){
    return view('auth.register');
   }

   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('login')
        ->withSuccess('You have successfully registered & logged in!');
    }


   public function login(){
    return view('auth.login');
   }

   public function authentication(Request $request){
        $credential = $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->
            withSuccess('You have Success Fully Logged In');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
   }

   public function dashboard(){
    if(Auth::check()){
        return view ('auth.dashboard');
    }
    return redirect()->route('login')-> withError([
        'email'=>'Please Login with acces Email'
    ])->onlYInput('email');
   }

   public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You Have Logout Succesfully');
   }

   public function profile()
   {
       // Retrieve the currently authenticated user
       $user = Auth::User();
   
       // Check if a user is not authenticated
       if (!$user) {
           return redirect()->route('login')->withError('Please log in to access your profile.');
       }
   
       // Pass the user data to the profile view
       return view('auth.dashboard', ['user' => $user]);
   }
   
}
