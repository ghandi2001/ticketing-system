<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'unit_id', 'ticket_priority_id', 'is_active'];

    protected $table = 'ticket_types';

    public $timestamps = true;

    public function unit()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class);
    }
}
