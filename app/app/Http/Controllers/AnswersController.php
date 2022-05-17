<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\StoreRequest;
use App\Http\Requests\Answer\UpdateRequest;
use App\Models\Answer;
use App\Models\AnswerTicket;
use App\Models\TicketPriority;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AnswersController extends Controller
{
    public static function routes()
    {
        Route::resource('answer', __CLASS__);
        Route::get('answer/relations/view/{answer}', [__CLASS__, 'showRelations'])->name('answer.relations.view');
        Route::post('answer/collective/destruction', [__CLASS__, 'collectiveDestruction'])->name('answer.collective.destruction');
        Route::post('answer/collective/change/status', [__CLASS__, 'collectiveChangeStatus'])->name('answer.collective.changeStatus');
        Route::post('answer/relations/storeOrDestructRelations/{answer}', [__CLASS__, 'storeOrDestructRelations'])->name('answer.relations.store.destruct');
    }

    public function index()
    {
        checkAccess('see readyAnswers');
        return view('answers.index')->with('answers', Answer::all());
    }

    public function create()
    {
        checkAccess('add readyAnswer');
        return view('answers.create');
    }

    public function store(StoreRequest $request)
    {
        checkAccess('add readyAnswer');
        $readyAnswer = new Answer();
        $readyAnswer->answer = $request->answer;
        if ($readyAnswer->save()) {
            return redirect()->back()->with('message', 'insert successfully.');
        }
        return redirect()->back()->with('error', 'insert not successfully.');
    }

    public function show(Answer $answer)
    {
        checkAccess('see readyAnswer');
        return view('answers.show')->with('answer', $answer);
    }

    public function edit(Answer $answer)
    {
        checkAccess('edit readyAnswer');
        return view('answers.create')->with('answer', $answer);
    }

    public function update(Answer $answer, UpdateRequest $request)
    {
        checkAccess('edit readyAnswer');
    }

    public function destroy(Answer $answer)
    {
        checkAccess('delete readyAnswer');
        if ($answer->delete())
            redirect()->back()->with('message', 'delete successfully.');
        return redirect()->back()->with('message', 'delete not successfully.');
    }

    public function collectiveDestruction(Request $request)
    {
        checkAccess('delete readyAnswer');
        Answer::whereIn('id', $request->input('data'))->update(['deleted_at' => now()]);
        return response()->json('mission successful.', '200');
    }

    public function collectiveChangeStatus(Request $request)
    {
        checkAccess('edit readyAnswer');

        $activatedAnswers = Answer::whereIn('id', $request->input('data'))->where('is_active', '=', 1)->get()->pluck('id');
        $noneActivatedAnswers = Answer::whereIn('id', $request->input('data'))->where('is_active', '=', 0)->get()->pluck('id');

        Answer::whereIn('id', $activatedAnswers)->update(['is_active' => 0]);
        Answer::whereIn('id', $noneActivatedAnswers)->update(['is_active' => 1]);

        return response()->json('mission successful.', '200');
    }

    public function showRelations(Answer $answer)
    {
        checkAccess('see readyAnswer relations');

        return view('answers.relations')->with([
            'answer' => $answer,
            'answerTicket' => AnswerTicket::where('answer_id', $answer->id),
            'ticketTypes' => TicketType::all(),
            'ticketPriorities' => TicketPriority::all()
        ]);
    }

    public function storeOrDestructRelations(Answer $answer, Request $request)
    {
        checkAccess('edit readyAnswer relations');

        if ($request->input('type') == 'priority') {
            $answerTicket = AnswerTicket::where('answer_id', $answer->id)->where('ticket_priority_id', $request->input('data'))->first();
            if ($answerTicket) {
                $answerTicket->delete();
            } else {
                $answersTicket = new AnswerTicket();
                $answersTicket->answer_id = $answer->id;
                $answersTicket->ticket_priority_id = $request->input('data');
                $answersTicket->saveOrFail();
            }
        } elseif ($request->input('type') == 'type') {
            $answerTicket = AnswerTicket::where('answer_id', $answer->id)->where('ticket_type_id', $request->input('data'))->first();
            if ($answerTicket) {
                $answerTicket->delete();
            } else {
                $answersTicket = new AnswerTicket();
                $answersTicket->answer_id = $answer->id;
                $answersTicket->ticket_type_id = $request->input('data');
                $answersTicket->saveOrFail();
            }
        } else {
            return response()->json('mission unsuccessful.', '500');
        }
        return response()->json('mission successful.', '200');
    }

}
