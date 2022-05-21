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
        checkAccess('see ticketPriorities');
        return view('ticket-priorities.index')->with('ticketPriorities', TicketPriority::all());
    }

    public function create()
    {
        checkAccess('add ticketPriority');
        return view('ticket-priorities.create')->with([
            'ticketTypes' => TicketType::all(),
            'units' => Unit::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add ticketPriority');
        $ticketPriority = new TicketPriority();
        $ticketPriority->title = $request->title;
        $ticketPriority->number = $request->number;
        $ticketPriority->description = $request->description;
        if ($ticketPriority->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(TicketPriority $ticketPriority)
    {
        checkAccess('see ticketPriority');
        return view('ticket-priorities.show')->with('ticketPriority', $ticketPriority);
    }

    public function edit(TicketPriority $ticketPriority)
    {
        checkAccess('edit ticketPriority');
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
        checkAccess('edit ticketPriority');
        if ($ticketPriority->updateOrFail([
            'title' => $request->title,
            'description' => $request->description,
            'number'=>$request->number
        ])) return redirect()->route('ticket-priority.index')->with('message', 'update successfully.');
    }

    public function destroy(TicketPriority $ticketPriority)
    {
        checkAccess('delete ticketPriority');
        if ($ticketPriority->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete ticketPriority');
        TicketPriority::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        checkAccess('edit ticketPriority');
        $activatedTicketPriorities = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedTicketPriorities = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        TicketPriority::whereIn('id', $activatedTicketPriorities)->update(['is_active' => 0]);
        TicketPriority::whereIn('id', $noneActivatedTicketPriorities)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }

}
