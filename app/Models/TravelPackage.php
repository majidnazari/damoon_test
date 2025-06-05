<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    /** @use HasFactory<\Database\Factories\TravelPackageFactory> */
    use HasFactory;
     protected $fillable = ['name', 'price', 'location'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }
}
