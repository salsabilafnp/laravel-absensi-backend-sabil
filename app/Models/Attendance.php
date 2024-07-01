<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'checkIn_time',
        'checkOut_time',
        'latlon_in',
        'latlon_out',
    ];

    // Relationships
    // to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
