<?php

namespace App\Http\Middleware;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Gdzie przekierować użytkowników po zalogowaniu.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Utwórz nową instancję kontrolera.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Pokaż formularz logowania aplikacji.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Użytkownik wylogował się z aplikacji.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}