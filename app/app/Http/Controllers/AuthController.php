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
            Route::post('sign-out', [__CLASS__, 'signOut'])->name('signOut');
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
            return redirect()->route('dashboard');
        }

        return redirect()->route('login.show')->with('message', 'username or password is invalid');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('master.index');
        }

        return redirect()->route('login.show');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('auth.login');
    }
}
