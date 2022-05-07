<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketType\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\TicketType;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;

class TicketTypeController extends Controller
{

    public static function routes()
    {
        Route::resource('ticket-type', __CLASS__);
    }

    public function index()
    {
        return view('ticket-types.index')->with('ticketTypes', TicketType::all());
    }

    public function create()
    {
        return view('ticket-types.create')->with('units', Unit::all());
    }

    public function store(StoreRequest $request)
    {
        $ticketType = new TicketType();
        $ticketType->title = $request->title;
        $ticketType->description = $request->description;
        $ticketType->unit_id = $request->unit;
        if ($ticketType->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(TicketType $ticketType)
    {
        return view('ticket-types.show')->with('ticketType', $ticketType);
    }

    public function edit(TicketType $ticketType)
    {
        return view('ticket-types.create')->with([
            'ticketType' => $ticketType,
            'units'=>Unit::all()
        ]);
    }

    public function update(TicketType $ticketType, UpdateRequest $request)
    {
        if ($ticketType->update(['title' => $request->title, 'description' => $request->description, 'unit_id' => $request->unit]))
            return redirect()->route('ticket-type.index')->with('message', 'update successfully.');
        return redirect()->back()->with('message', 'update not successfully.');
    }

    public function destroy(TicketType $ticketType)
    {
        if ($ticketType->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('error', 'delete not successfully.');
    }
}
