<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['answer', 'is_active'];

    protected $table = 'answers';

    public $timestamps = true;

    public function ticketPriority()
    {
        return $this->belongsToMany(TicketPriority::class, 'answer_ticket');
    }

    public function ticketType()
    {
        return $this->belongsToMany(TicketType::class, 'answer_ticket');
    }

}
