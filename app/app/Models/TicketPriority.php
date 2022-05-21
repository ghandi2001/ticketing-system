<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = ['title', 'description', 'is_active', 'number'];

    protected $table = 'ticket_priorities';

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
