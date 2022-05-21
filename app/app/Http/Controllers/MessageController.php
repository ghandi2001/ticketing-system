<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Models\AnswerTicket;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Psr\Container\NotFoundExceptionInterface;

class MessageController extends Controller
{

    public static function routes()
    {
        Route::prefix('tickets/chat')->group(function () {
            Route::resource('messages', __CLASS__);
        });
    }

    public function index()
    {
        return abort(404);
    }

    public function create()
    {
        return abort(404);
    }

    public function store(StoreRequest $request)
    {
        $message = new Message();
        if ($request->readyAnswer != 'none'){
            $message->message = $request->readyAnswer;
        }else{
            $message->message = $request->message;
        }
        $message->user_id = Auth::id();
        if (json_decode($request->ticket)->user_id != Auth::id()) $message->is_server = true;
        $message->ticket_id = json_decode($request->ticket)->id;
        $message->save();
        return redirect()->back();
    }

    public function show($ticketId)
    {
        $ticket = Ticket::query()->findOrFail($ticketId);
        try {
            $ticketType = AnswerTicket::query()->where('ticket_type_id', $ticket->ticket_type_id)->get();
            $ticketPriority = AnswerTicket::query()->where('ticket_priority_id', TicketType::query()->find($ticket->ticket_type_id)->ticket_priority_id)->get();
            $answers = $ticketType->merge($ticketPriority);
            $answers = $answers->unique('answer_id');
        } catch (NotFoundExceptionInterface $exception) {
            $answers = null;
        }
        return view('messages.show')->with([
            'messages' => Message::query()->where('ticket_id', $ticketId)->get(),
            'ticket' => $ticket,
            'answers' => $answers
        ]);
    }

    public function edit(Message $message)
    {
        return abort(404);
    }

    public function update(Request $request, Message $message)
    {
        return abort(404);
    }

    public function destroy(Message $message)
    {
        //
    }
}
