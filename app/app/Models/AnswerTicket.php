<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTicket extends Model
{
    use HasFactory;

    protected $fillable = ['answer_id', 'ticket_priority_id', 'ticket_type_id'];

    protected $table = 'answer_ticket';

    public $timestamps = true;

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

}
