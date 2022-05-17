<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\TicketPriority;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    public static function routes()
    {
        Route::resource('unit', __CLASS__);
        Route::post('/unit/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('unit.collective.destruction');
        Route::post('/unit/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('unit.collective.changeStatus');
    }

    public function index()
    {
        checkAccess('see units');
        return view('units.index')->with('units', Unit::all());
    }

    public function create()
    {
        checkAccess('add unit');
        return view('units.create')->with('ticketPriorities', TicketPriority::all());
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add unit');
        $unit = new Unit();
        $unit->title = $request->title;
        $unit->description = $request->description;
        $unit->ticket_priority_id = $request->ticket_priority_id;
        if ($unit->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert successfully.');
    }

    public function show(Unit $unit)
    {
        checkAccess('see unit');
        return view('units.show')->with([
            'unit' => $unit
        ]);
    }

    public function edit(Unit $unit)
    {
        checkAccess('edit unit');
        return view('units.create')->with([
            'unit' => $unit,
            'ticketPriorities' => TicketPriority::all()
        ]);
    }

    public function update(Unit $unit, UpdateRequest $request)
    {
        checkAccess('edit unit');
        if ($unit->update(['title' => $request->title, 'description' => $request->description, 'ticket_priority_id' => $request->ticket_priority_id]))
            return redirect()->route('unit.index')->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function destroy(Unit $unit)
    {
        checkAccess('delete unit');
        if ($unit->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('error', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete unit');
        Unit::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        checkAccess('edit unit');
        $activatedUnit = Unit::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedUnit = Unit::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        Unit::whereIn('id', $activatedUnit)->update(['is_active' => 0]);
        Unit::whereIn('id', $noneActivatedUnit)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }
}
