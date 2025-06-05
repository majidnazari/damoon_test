<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable = ['package_id', 'customer_name', 'customer_email', 'travel_date'];

    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class, 'package_id');
    }
}
