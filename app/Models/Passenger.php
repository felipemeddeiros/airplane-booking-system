<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking')->where('canceled', 0);
    }
}
