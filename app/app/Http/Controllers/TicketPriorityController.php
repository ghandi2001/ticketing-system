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
        return view('ticket-priorities.index');
    }

    public function create()
    {
        return view('ticket-priorities.create')->with([
            'ticketTypes' => TicketType::all()
        ]);
    }

    public function store(CreateRequest $request)
    {
        $ticketPriority = new TicketPriority();
        $ticketPriority->title = $request->title;
        $ticketPriority->description = $request->description;
        $ticketPriority->ticket_type_id = $request->ticket_type_id;
        if($ticketPriority->save()){
            return view('ticket-groups.index')->with('message','insert successfully.');
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
