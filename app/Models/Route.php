<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stops()
    {
        return $this->belongsToMany(Stop::class, 'stop_times')->withPivot('arrival_time', 'departure_time');
    }

    public function stopTimes()
    {
        return $this->hasMany(StopTime::class);
    }

    public function routeDates()
    {
        return $this->hasMany(RouteDate::class);
    }
}
