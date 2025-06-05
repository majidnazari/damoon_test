<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TravelPackage;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelPackageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_bookings()
    {
        $package = TravelPackage::factory()->create();
        $booking = Booking::factory()->create(['package_id' => $package->id]);

        $this->assertTrue($package->bookings->contains($booking));
        $this->assertInstanceOf(Booking::class, $package->bookings->first());
    }

     /** @test */
    // public function index_with_join_returns_expected_structure()
    // {
    //     $package = TravelPackage::factory()->create();
    //     Booking::factory()->create(['package_id' => $package->id]);

    //     $response = $this->getJson('/api/travel-packages-join'); 

    //     $response->assertStatus(200);
    //     $response->assertJsonFragment(['id' => $package->id]);
    // }

    //  /** @test */
    // public function index_returns_expected_structure()
    // {
    //     $package = TravelPackage::factory()->create();
    //     Booking::factory()->count(2)->create(['package_id' => $package->id]);

    //     $response = $this->getJson('/api/travel-packages'); 

    //     $response->assertStatus(200);
    //     $response->assertJsonStructure([
    //         '*' => ['id', 'name', 'price', 'location', 'total_bookings', 'customers' => [
    //             '*' => ['customer_name', 'customer_email']
    //         ]]
    //     ]);
    // }
}

