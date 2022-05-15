<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketPriority\StoreRequest;
use App\Http\Requests\TicketPriority\UpdateRequest;
use App\Models\TicketPriority;
use App\Models\TicketType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TicketPriorityController extends Controller
{

     public static function routes()
    {
        Route::resource('ticket-priority', __CLASS__);
        Route::post('/ticket/priority/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('ticket.priority.collective.destruction');
        Route::post('/ticket/priority/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('ticket.priority.collective.changeStatus');
    }

    public function index()
    {
        return view('ticket-priorities.index')->with('ticketPriorities', TicketPriority::all());
    }

    public function create()
    {
        return view('ticket-priorities.create')->with([
            'ticketTypes' => TicketType::all(),
            'units' => Unit::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $ticketPriority = new TicketPriority();
        $ticketPriority->title = $request->title;
        $ticketPriority->description = $request->description;
        if ($ticketPriority->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(TicketPriority $ticketPriority)
    {
        return view('ticket-priorities.show')->with('ticketPriority', $ticketPriority);
    }

    public function edit(TicketPriority $ticketPriority)
    {
        if ($ticketPriority->unit_id) {
            $state = 'unit';
        } else {
            $state = 'ticketType';
        }

        return view('ticket-priorities.create')->with([
            'ticketPriority' => $ticketPriority,
            'ticketTypes' => TicketType::all(),
            'units' => Unit::all(),
            'state' => json_encode($state),
        ]);
    }

    public function update(TicketPriority $ticketPriority, UpdateRequest $request)
    {
        if ($ticketPriority->updateOrFail([
            'title' => $request->title,
            'description' => $request->description,
        ])) return redirect()->route('ticket-priority.index')->with('message', 'update successfully.');
    }

    public function destroy(TicketPriority $ticketPriority)
    {
        if ($ticketPriority->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        TicketPriority::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        $activatedTicketTypes = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedTicketTypes = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        TicketPriority::whereIn('id', $activatedTicketTypes)->update(['is_active' => 0]);
        TicketPriority::whereIn('id', $noneActivatedTicketTypes)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }

}
