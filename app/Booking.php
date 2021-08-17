<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    function bookingDetails(){
        return $this->hasMany(BookingDetail::class);
    }
}
