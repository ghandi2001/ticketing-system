<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'surname',
        'gender',
        'phone_number',
        'personnel_code',
        'profile_picture',
        'password',
        'has_accessed'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'phone_number_verified_at' => 'datetime',
    ];

    public function getOpenTickets()
    {
        return $this->hasMany(Ticket::class)->count();
    }

    public function getClosedTickets()
    {
        return $this->hasMany(Ticket::class)->where('closed_at', null)->count();
    }
}
