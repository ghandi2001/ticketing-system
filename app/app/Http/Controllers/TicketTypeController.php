<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketType\CreateRequest;
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
        return view('ticket-types.index');
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
        if($ticketType->save()){
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
