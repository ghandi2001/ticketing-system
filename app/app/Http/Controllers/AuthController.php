<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public static function routes()
    {
        Route::prefix('auth')->group(function () {
            Route::get('login', [__CLASS__, 'index'])->name('login.show');
            Route::post('custom-login', [__CLASS__, 'customLogin'])->name('login');
            Route::post('logout', [__CLASS__, 'signOut'])->name('logout');
        });
    }

    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone_number', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'phone_number' => 'username or password is invalid.',
        ])->onlyInput('email');
    }



    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login.show');
    }
}
