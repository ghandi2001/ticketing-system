<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketType\CreateRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
        return view('ticket-types.create');
    }

    public function store(CreateRequest $request)
    {
        $ticketType = new TicketType();
        $ticketType->title = $request->title;
        $ticketType->description = $request->description;
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
        return view('ticket-types.create')->with('ticketType', $ticketType);
    }

    public function update(TicketType $ticketType, UpdateRequest $request)
    {
        if ($ticketType->update(['title' => $request->title, 'description' => $request->description]))
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
