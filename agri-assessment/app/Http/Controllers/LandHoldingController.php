<?php

namespace App\Http\Controllers;

use App\Models\LandHolding;
use App\Models\Region;
use App\Models\Farmer;
use Illuminate\Http\Request;

class LandHoldingController extends Controller
{
    // Display a listing of the resource (index view)
    public function index()
    {
        $landholdings = LandHolding::with('region', 'farmer')->get(); // Also eager load farmer
        return view('landholding.index', compact('landholdings'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $regions = Region::all();
        $farmers = Farmer::all();
        return view('landholding.create', compact('regions', 'farmers'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|numeric|min:0'
        ]);

        LandHolding::create([
            'farmer_id' => $request->farmer_id,
            'region_id' => $request->region_id,
            'area' => $request->area
        ]);

        return redirect()->route('landholding.index')->with('success', 'Landholding added successfully.');
    }

    // Display the specified resource
    public function show($id)
    {
        $landholding = LandHolding::findOrFail($id);
        return view('landholding.show', compact('landholding'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $landholding = LandHolding::findOrFail($id);
        $regions = Region::all();
        $farmers = Farmer::all(); // 🛠️ ADD THIS line

        return view('landholding.edit', compact('landholding', 'regions', 'farmers'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|numeric|min:0'
        ]);

        $landholding = LandHolding::findOrFail($id);
        $landholding->update([
            'farmer_id' => $request->farmer_id,
            'region_id' => $request->region_id,
            'area' => $request->area
        ]);

        return redirect()->route('landholding.index')->with('success', 'Landholding updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $landholding = LandHolding::findOrFail($id);
        $landholding->delete();

        return redirect()->route('landholding.index')->with('success', 'Landholding deleted successfully.');
    }

    // Display the graph of landholdings by region
    public function showGraph()
    {
        $landholdings = LandHolding::with('region')
            ->selectRaw('region_id, SUM(area) as total_area')
            ->groupBy('region_id')
            ->get();

        $regionNames = $landholdings->map(function ($item) {
            return $item->region ? $item->region->name : 'Unknown';
        });

        $totalAreas = $landholdings->pluck('total_area');

        return view('landholding.graph', [
            'regionNames' => $regionNames,
            'totalAreas' => $totalAreas
        ]);
    }
}
