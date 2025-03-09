<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'location'];

    public function routes()
    {
        return $this->belongsToMany(Route::class, 'stop_times')
                    ->withPivot('arrival_time', 'departure_time');
    }
    
    public function stopTimes()
    {
        return $this->hasMany(StopTime::class);
    }
}
