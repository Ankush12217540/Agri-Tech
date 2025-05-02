<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Region;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    // Show the list of farmers (index view)
    public function index()
    {
        $farmers = Farmer::with('landHolding', 'region')->get(); // Load region and landholding
        return view('farmers.index', compact('farmers'));
    }

    // Show the form for creating a new farmer
    public function create()
    {
        $regions = Region::all();
        return view('farmers.create', compact('regions'));
    }

    // Store a newly created farmer in the database
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'region_id'      => 'required|exists:regions,id',
            'land_holding'   => 'required|numeric',
            'ownership_type' => 'required|string|max:255',
            'status'         => 'required|string|max:255',
        ]);

        // Create the farmer
        $farmer = Farmer::create([
            'name'      => $request->name,
            'region_id' => $request->region_id,
            'status'    => $request->status,
        ]);

        // Create land holding
        $farmer->landHolding()->create([
            'area'           => $request->land_holding,
            'ownership_type' => $request->ownership_type,
            'region_id'      => $request->region_id,
        ]);

        return redirect()->route('farmers.index')->with('success', 'Farmer added successfully!');
    }

    // Show the form for editing a farmer
    public function edit($id)
    {
        $farmer = Farmer::with('landHolding')->findOrFail($id);
        $regions = Region::all();
        return view('farmers.edit', compact('farmer', 'regions'));
    }

    // Update the specified farmer in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'region_id'      => 'required|exists:regions,id',
            'land_holding'   => 'required|numeric',
            'ownership_type' => 'required|string|max:255',
            'status'         => 'required|string|max:255',
        ]);

        $farmer = Farmer::findOrFail($id);
        $farmer->update([
            'name'      => $request->name,
            'region_id' => $request->region_id,
            'status'    => $request->status,
        ]);

        $farmer->landHolding()->updateOrCreate(
            ['farmer_id' => $farmer->id],
            [
                'area'           => $request->land_holding,
                'ownership_type' => $request->ownership_type,
                'region_id'      => $request->region_id,
            ]
        );

        return redirect()->route('farmers.index')->with('success', 'Farmer updated successfully!');
    }

    // Delete a farmer
    public function destroy($id)
    {
        $farmer = Farmer::findOrFail($id);

        $farmer->landHolding()->delete();
        $farmer->delete();

        return redirect()->route('farmers.index')->with('success', 'Farmer deleted successfully!');
    }
}
