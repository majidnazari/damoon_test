<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use App\Http\Requests\StoreTravelPackageRequest;
use App\Http\Requests\UpdateTravelPackageRequest;
use Illuminate\Support\Facades\DB;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $packages = TravelPackage::with(['bookings:id,package_id,customer_name,customer_email'])
        ->withCount('bookings')
        ->get()
        ->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->price,
                'location' => $package->location,
                'total_bookings' => $package->bookings_count,
                'customers' => $package->bookings->map(function ($booking) {
                    return [
                        'customer_name' => $booking->customer_name,
                        'customer_email' => $booking->customer_email,
                    ];
                })->values(),
            ];
        });

    return response()->json($packages);
    }

    public function indexWithJoin()
    {
       // dd("runs here for join travel");
        $packages = DB::table('travel_packages as tp')
            ->leftJoin('bookings as b', 'tp.id', '=', 'b.package_id')
            ->select(
                'tp.id',
                'tp.name',
                'tp.price',
                'tp.location',
                DB::raw('COUNT(b.id) as total_bookings')
            )
            ->groupBy('tp.id', 'tp.name', 'tp.price', 'tp.location')
            ->get();

        // Fetch all bookings grouped by package_id
        $bookings = DB::table('bookings')
            ->select('package_id', 'customer_name', 'customer_email')
            ->get()
            ->groupBy('package_id');

        // Combine results
       $result = $packages->map(function ($package) use ($bookings) {
            $packageBookings = $bookings->get($package->id, collect());

            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->price,
                'location' => $package->location,
                'total_bookings' => $package->total_bookings,
                'customers' => $packageBookings->map(function ($booking) {
                    return [
                        'customer_name' => $booking->customer_name,
                        'customer_email' => $booking->customer_email,
                    ];
                })->values(),
            ];
        });

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelPackageRequest $request)
    {
        $validated = $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'location' => 'required|string',
    ]);

    $package = TravelPackage::create($validated);

    return response()->json($package, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelPackageRequest $request, TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelPackage $travelPackage)
    {
        //
    }
}
