<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{

    public static function routes()
    {
        Route::get('/', [__CLASS__, 'index'])->name('home.index');
    }

    public function index()
    {
        if (Auth::check()) {
            return view('home.index')->with([
                'tickets'=>Ticket::all()
            ]);
        }

        return redirect()->route('login.show');
    }
}
