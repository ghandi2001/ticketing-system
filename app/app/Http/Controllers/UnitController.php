<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UnitController extends Controller
{

    public static function routes()
    {
        Route::resource('unit',__CLASS__);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
