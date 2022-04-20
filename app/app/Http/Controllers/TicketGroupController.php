<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketGroup\CreateRequest;
use App\Models\TicketGroup;
use Illuminate\Support\Facades\Route;

class TicketGroupController extends Controller
{

    public static function routes()
    {
        Route::resource('ticket-group', __CLASS__);
    }

    public function index()
    {
        return view('ticket-groups.index')->with([
            'ticketGroups'=>TicketGroup::all()
        ]);
    }

    public function create()
    {
        return view('ticket-groups.create');
    }

    public function store(CreateRequest $request)
    {
        $ticketGroup = new TicketGroup();
        $ticketGroup->title = $request->title;
        $ticketGroup->description = $request->description;
        if($ticketGroup->save()){
            return redirect()->back()->with('message','insert successfully.');
        }
        return redirect()->back()->with('message','insert not successfully.');
    }

    public function show(TicketGroup $ticketGroup)
    {
        return view('ticket-groups.show')->with('ticketGroup',$ticketGroup);
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy(TicketGroup $ticketGroup)
    {
        if($ticketGroup->delete())
            redirect()->back()->with('message','delete successfully.');
        return redirect()->back()->with('message','delete not successfully.');
    }
}
