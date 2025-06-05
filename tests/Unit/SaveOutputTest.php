<?php

namespace Tests\Unit;

use Tests\TestCase; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class SaveOutputTest extends TestCase
{
    protected array $fakeApiResponse = [
        "status" => "OK",
        "neighbourhood" => "حر",
        "municipality_zone" => "11",
        "state" => "استان تهران",
        "city" => "تهران",
        "in_traffic_zone" => false,
        "in_odd_even_zone" => true,
        "route_name" => "امام خمینی",
        "route_type" => "primary",
        "place" => "دانشگاه فرماندهی و ستاد",
        "district" => "بخش مرکزی شهرستان تهران",
        "formatted_address" => "تهران، امام خمینی",
        "village" => null,
        "county" => "شهرستان تهران"
    ];

    protected function setUp(): void
    {
        parent::setUp();

        File::shouldReceive('put')
            ->once()
            ->withArgs(function ($path, $json) {
                return $path === base_path('output.json') &&
                       json_decode($json, true) === $this->fakeApiResponse;
            });
    }

    public function test_save_output_with_fake_response()
    {
        Http::fake([
           env('NESHAN_ENDPOINT', 'https://api.neshan.org/v5/reverse*') => Http::response($this->fakeApiResponse, 200),
        ]);

        $response = app()->call('App\Http\Controllers\GeoServiceController@saveOutput');

        $this->assertEquals(['message' => 'Output saved successfully'], $response->getData(true));
        $this->assertEquals(200, $response->getStatusCode());
    }

   public function test_only_expected_coordinates_return_successful_response()
    {
        $expectedLat = 35.6892;
        $expectedLng = 51.3890;

        Http::fake(function ($request) use ($expectedLat, $expectedLng) {
            $query = [];
            parse_str(parse_url($request->url(), PHP_URL_QUERY), $query);

            $isExpectedCoords = isset($query['lat'], $query['lng']) &&
                (float)$query['lat'] === $expectedLat &&
                (float)$query['lng'] === $expectedLng;

            return $isExpectedCoords
                ? Http::response($this->fakeApiResponse, 200)
                : Http::response(['error' => 'Invalid coordinates'], 400);
        });

        $response = app()->call('App\Http\Controllers\GeoServiceController@saveOutput');

        $this->assertEquals(['message' => 'Output saved successfully'], $response->getData(true));
        $this->assertEquals(200, $response->getStatusCode());
    }

}
