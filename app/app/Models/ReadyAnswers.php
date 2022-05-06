<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadyAnswers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['answer', 'is_active', 'tickets_type_id', 'ticket_group_id'];

    protected $table = 'ready_answers';

    public $timestamps = true;

    public function ticketGroup()
    {
        return $this->belongsToMany(TicketGroup::class);
    }
}
