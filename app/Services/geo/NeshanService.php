<?php

namespace App\Services\geo;

use Illuminate\Support\Facades\Http;

class NeshanService
{
    public function reverseGeocode(float $lat, float $lng): ?array
    {
        $response = Http::withHeaders([
            'Api-Key' => env('NESHAN_API_KEY'),
        ])->get( env('NESHAN_ENDPOINT'), [
            'lat' => $lat,
            'lng' => $lng,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
