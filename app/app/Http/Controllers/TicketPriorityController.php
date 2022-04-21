<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketPriority\CreateRequest;
use App\Models\TicketPriority;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class TicketPriorityController extends Controller
{

    public static function routes()
    {
        Route::resource('ticket-priority', __CLASS__);
    }

    public function index()
    {
        return view('ticket-priorities.index')->with('ticketPriorities', TicketPriority::all());
    }

    public function create()
    {
        return view('ticket-priorities.create')->with('ticketTypes', TicketType::all());
    }

    public function store(CreateRequest $request)
    {
        $ticketPriority = new TicketPriority();
        $ticketPriority->title = $request->title;
        $ticketPriority->description = $request->description;
        $ticketPriority->ticket_type_id = $request->ticket_type;
        if ($ticketPriority->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(TicketPriority $ticketPriority)
    {
        return view('ticket-priorities.show')->with('ticketPriority',$ticketPriority);
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy(TicketPriority $ticketPriority)
    {
        if($ticketPriority->delete())
            redirect()->back()->with('message','delete successfully.');
        return redirect()->back()->with('message','delete not successfully.');
    }
}
