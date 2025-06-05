<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TravelPackage;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_travel_package()
    {
        $package = TravelPackage::factory()->create();
        $booking = Booking::factory()->create(['package_id' => $package->id]);

        $this->assertInstanceOf(TravelPackage::class, $booking->travelPackage);
        $this->assertEquals($package->id, $booking->travelPackage->id);
    }
}
