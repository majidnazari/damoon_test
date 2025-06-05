<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use App\Services\geo\NeshanService;
use Illuminate\Http\Request;

class GeoServiceController extends Controller
{
  protected $neshan;

    public function __construct(NeshanService $neshan)
    {
        $this->neshan = $neshan;
    }

    public function saveOutput()
    {
        $lat = 35.6892;
        $lng = 51.3890;

        $data = $this->neshan->reverseGeocode($lat, $lng);

        if ($data) {
            File::put(base_path('output.json'), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return response()->json(['message' => 'Output saved successfully']);
        }

        return response()->json(['message' => 'Failed to get data from Neshan'], 500);
    }
}
