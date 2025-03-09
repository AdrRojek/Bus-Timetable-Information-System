<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/routes';

    public function __construct()
    {
        // No need to call middleware here
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|min:4',
        'password' => 'required|min:7',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        if (Auth::user()->isAdmin()) {
            return redirect('/admin'); 
        }
        return redirect()->intended($this->redirectTo);
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records. Please check your email and password and try again.',
    ]);
}



    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
