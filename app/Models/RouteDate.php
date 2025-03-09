<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteDate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['route_id', 'date'];
    protected $casts = [
        'date' => 'date',
    ];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
