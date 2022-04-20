<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\CreateRequest;
use App\Models\Unit;
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

    public function store(CreateRequest $request)
    {
        $unit = new Unit();
        $unit->title = $request->title;
        $unit->description = $request->description;
        if($unit->save()){
            return view('unit.index')->with('message','insert successfully.');
        }
        return redirect()->back()->with('message','insert successfully.');
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
