<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
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
//        return view('')->with([
//            'tickets' => Ticket::all()
//        ]);
    }

    public function create()
    {
        return view('tickets.create')->with([
            'ticketPriorities' => TicketPriority::all(),
            'ticketTypes' => TicketType::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->ticket_type_id = $request->ticket_type;
        $ticket->user_id = Auth::id();
        if ($ticket->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('message', 'insert not successfully.');
    }

    public function show(Ticket $ticketGroup)
    {
//        return view('ticket-groups.show')->with('ticketGroup', $ticketGroup);
    }

    public function edit(Ticket $ticketGroup)
    {
//        return view('ticket-groups.create')->with('ticketGroup', $ticketGroup);
    }

    public function update(Ticket $ticketGroup, UpdateRequest $request)
    {
//        if($ticketGroup->update(['title'=>$request->title,'description'=>$request->description]))
//            return redirect()->route('ticket-group.index')->with('message', 'delete successfully.');
//        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function destroy(Ticket $ticketGroup)
    {
//        if ($ticketGroup->delete())
//            redirect()->back()->with('message', 'delete successfully.');
//        return redirect()->back()->with('message', 'delete not successfully.');
    }
}
