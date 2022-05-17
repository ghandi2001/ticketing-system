<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketType\StoreRequest;
use App\Http\Requests\TicketType\UpdateRequest;
use App\Models\TicketPriority;
use App\Models\TicketType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TicketTypeController extends Controller
{

    public static function routes()
    {
        Route::resource('ticket-type', __CLASS__);
        Route::post('ticket/type/get/ticket/priority', [__CLASS__, 'getUnitPriority'])->name('ticket.type.get.unit.priority');
        Route::post('/ticket/type/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('ticket.type.collective.destruction');
        Route::post('/ticket/type/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('ticket.type.collective.changeStatus');
    }

    public function index()
    {
        checkAccess('see ticketTypes');
        return view('ticket-types.index')->with('ticketTypes', TicketType::all());
    }

    public function create()
    {
        checkAccess('add ticketType');
        return view('ticket-types.create')->with([
            'units' => Unit::all(),
            'ticketPriorities' => TicketPriority::all()
        ]);
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add ticketType');
        $ticketType = new TicketType();
        $ticketType->title = $request->title;
        $ticketType->description = $request->description;
        $ticketType->unit_id = $request->unit_id;
        $ticketType->ticket_priority_id = $request->ticket_priority_id;
        if ($ticketType->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(TicketType $ticketType)
    {
        checkAccess('see ticketType');
        return view('ticket-types.show')->with('ticketType', $ticketType);
    }

    public function edit(TicketType $ticketType)
    {
        checkAccess('edit ticketType');
        return view('ticket-types.create')->with([
            'ticketType' => $ticketType,
            'ticketPriorities' => TicketPriority::all(),
            'units' => Unit::all()
        ]);
    }

    public function update(TicketType $ticketType, UpdateRequest $request)
    {
        checkAccess('edit ticketType');
        if ($ticketType->update([
            'title' => $request->title,
            'description' => $request->description,
            'unit_id' => $request->unit_id,
            'ticket_priority_id' => $request->ticket_priority_id
        ])) return redirect()->route('ticket-type.index')->with('message', 'update successfully.');
        return redirect()->back()->with('message', 'update not successfully.');
    }

    public function destroy(TicketType $ticketType)
    {
        checkAccess('delete ticketType');
        if ($ticketType->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('error', 'delete not successfully.');
    }

    public function getUnitPriority(Request $request)
    {
        checkAccess('edit ticketType');
        return response(Unit::findOrFail($request->input('unit_id')), '200');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete ticketType');
        TicketType::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        checkAccess('edit ticketType');
        $activatedTicketTypes = TicketType::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedTicketTypes = TicketType::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        TicketType::whereIn('id', $activatedTicketTypes)->update(['is_active' => 0]);
        TicketType::whereIn('id', $noneActivatedTicketTypes)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }
}
