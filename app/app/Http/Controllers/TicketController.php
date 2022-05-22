<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TicketController extends Controller
{
    public static function routes()
    {
        Route::resource('ticket', __CLASS__);
    }

    public function index()
    {
        checkAccess('see tickets');
        return view('tickets.index')->with('tickets', Ticket::all());
    }

    public function create()
    {
        checkAccess('add ticket');
        return view('tickets.create')->with([
            'ticketPriorities' => TicketPriority::all(),
            'ticketTypes' => TicketType::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add ticket');
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->ticket_type_id = $request->ticket_type;
        $ticket->user_id = Auth::id();
        $ticket->save();

        $message = new Message();
        $message->message = $request->description;
        $message->user_id = Auth::id();
        $message->ticket_id = $ticket->id;
        $message->save();
        return redirect()->back()->with('message', 'insert successfully.');

    }

    public function show(Ticket $ticketGroup)
    {
        return abort(404);
    }

    public function edit(Ticket $ticket)
    {
        $ticket->update(['closed_at' => now()]);
        return redirect()->back();
    }

    public function update(Ticket $ticketGroup, UpdateRequest $request)
    {
        return abort(404);
    }

    public function destroy(Ticket $ticketGroup)
    {
        return abort(404);
    }

}
