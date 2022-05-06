<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'ticket_type_id', 'is_active'];

    protected $table = 'ticket_priorities';

    public $timestamps = true;

}
