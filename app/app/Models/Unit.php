<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'is_active', 'ticket_priority_id'];

    protected $table = 'units';

    public $timestamps = true;

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class);
    }
}
