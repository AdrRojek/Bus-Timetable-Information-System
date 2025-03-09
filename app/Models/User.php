<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean',
    ];

    public $timestamps = false;

    public function isAdmin()
    {
        return $this->admin;
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function routeDates()
    {
        return $this->hasManyThrough(RouteDate::class, Route::class);
    }
}
