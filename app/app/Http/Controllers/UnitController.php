<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;

class UnitController extends Controller
{

    public static function routes()
    {
        Route::resource('unit', __CLASS__);
    }

    public function index()
    {
        return view('units.index')->with('units', Unit::all());
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(StoreRequest $request)
    {
        $unit = new Unit();
        $unit->title = $request->title;
        $unit->description = $request->description;
        if ($unit->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert successfully.');
    }

    public function show(Unit $unit)
    {
        return view('units.show')->with('unit', $unit);
    }

    public function edit(Unit $unit)
    {
        return view('units.create')->with('unit', $unit);
    }

    public function update(Unit $unit, UpdateRequest $request)
    {
        if ($unit->update(['title' => $request->title, 'description' => $request->description]))
            return redirect()->route('unit.index')->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('error', 'delete not successfully.');
    }
}
