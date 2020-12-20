<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    public function booking($passenger, $rowNumber, $rowSeat)
    {
        $this->reservations()->create([
            'passenger_id' => $passenger->id,
            'row_number'   => $rowNumber,
            'row_seat'     => $rowSeat,
        ]);
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
