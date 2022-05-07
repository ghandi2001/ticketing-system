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

    private const TYPE_OF_PRIORITIES = ['none', 'ticketType', 'unit'];

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
        $typeOfPrioritiesWithMessage = array_combine(self::TYPE_OF_PRIORITIES, ['انتخاب کنید', 'نوع تیکت', 'تیکت های مربوط به بخش']);
        return view('ticket-priorities.create')->with([
            'ticketTypes' => TicketType::all(),
            'units' => Unit::all(),
            'type_of_priorities' => $typeOfPrioritiesWithMessage
        ]);
    }

    public function store(StoreRequest $request)
    {
        $ticketPriority = new TicketPriority();
        $ticketPriority->title = $request->title;
        $ticketPriority->description = $request->description;
        if ($request->type_of_priority == 'ticketType') {
            $ticketPriority->ticket_type_id = $request->ticket_type_id;
        } else {
            $ticketPriority->unit_id = $request->unit_id;
        }
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

        $typeOfPrioritiesWithMessage = array_combine(self::TYPE_OF_PRIORITIES, ['انتخاب کنید', 'نوع تیکت', 'تیکت های مربوط به بخش']);
        return view('ticket-priorities.create')->with([
            'ticketPriority' => $ticketPriority,
            'ticketTypes' => TicketType::all(),
            'units' => Unit::all(),
            'state' => json_encode($state),
            'type_of_priorities' => $typeOfPrioritiesWithMessage
        ]);
    }

    public function update(TicketPriority $ticketPriority, UpdateRequest $request)
    {
        $ticketTypeId = null;
        $unitId = null;
        if ($request->type_of_priority == self::TYPE_OF_PRIORITIES[1]) {
            $ticketTypeId = $request->ticket_type_id;
        } else if ($request->type_of_priority == self::TYPE_OF_PRIORITIES[2]) {
            $unitId = $request->unit_id;
        } else {
            return redirect()->back()->with('message', 'update not successfully.');
        }

        if ($ticketPriority->updateOrFail([
            'title' => $request->title,
            'description' => $request->description,
            'ticket_type_id' => $ticketTypeId,
            'unit_id' => $unitId
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
        $activatedTicketTyped = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedTicketTyped = TicketPriority::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        TicketPriority::whereIn('id', $activatedTicketTyped)->update(['is_active' => 0]);
        TicketPriority::whereIn('id', $noneActivatedTicketTyped)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }

}
