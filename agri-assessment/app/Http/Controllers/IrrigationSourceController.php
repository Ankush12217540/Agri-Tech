<?php

namespace App\Http\Controllers;

use App\Models\IrrigationSource;
use App\Models\Farmer;
use App\Models\Region;
use App\Models\Crop;
use App\Models\Technique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\IrrigationRecommendation; // Add this to import the mail class for recommendations

class IrrigationSourceController extends Controller
{
    public function show($id)
    {
        $irrigation = IrrigationSource::findOrFail($id);
        return view('irrigationsources.show', compact('irrigation'));
    }

    // Show all irrigation sources
    public function index()
    {
        $irrigations = IrrigationSource::with('region')->get();
        return view('irrigationsources.index', compact('irrigations'));
    }

    // Show form to create a new irrigation source
    public function create()
    {
        $regions = Region::all();
        return view('irrigationsources.create', compact('regions'));
    }

    // Store a new irrigation source
    public function store(Request $request)
    {
        // Validate request input
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'source_type' => 'required|string|max:255',
        ]);

        // Create irrigation source
        IrrigationSource::create([
            'region_id' => $request->region_id,
            'source_type' => $request->source_type,
        ]);

        return redirect()->route('irrigationsources.index')->with('success', 'Irrigation Source created successfully');
    }

    // Show form to edit an irrigation source
    public function edit(IrrigationSource $irrigation)
    {
        $regions = Region::all();
        return view('irrigationsources.edit', compact('irrigation', 'regions'));
    }

    // Update an existing irrigation source
    public function update(Request $request, IrrigationSource $irrigation)
    {
        // Validate request input
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'source_type' => 'required|string|max:255',
        ]);

        // Update irrigation source data
        $irrigation->update([
            'region_id' => $request->region_id,
            'source_type' => $request->source_type,
        ]);

        return redirect()->route('irrigationsources.index')->with('success', 'Irrigation Source updated successfully');
    }

    // Delete an irrigation source
    public function destroy(IrrigationSource $irrigation)
    {
        // Delete the irrigation source
        $irrigation->delete();
        return redirect()->route('irrigationsources.index')->with('success', 'Irrigation Source deleted successfully');
    }

    // Generate GeoJSON for irrigation sources based on region coordinates
    private function generateGeoJsonForIrrigationSource($irrigations)
    {
        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($irrigations as $irrigation) {
            $region = $irrigation->region;
            $irrigationSource = $irrigation->source_type;

            // Assuming Region has coordinates stored in a 'coordinates' column (JSON)
            if ($region && $region->coordinates) {
                $geoJson['features'][] = [
                    'type' => 'Feature',
                    'properties' => [
                        'name' => $region->name,
                        'irrigation_source' => $irrigationSource,
                    ],
                    'geometry' => json_decode($region->coordinates),
                ];
            }
        }

        return json_encode($geoJson);
    }

    // Display irrigation statistics (Overview)
    public function overview()
    {
        $irrigationData = \App\Models\IrrigationSource::select('source_type', \DB::raw('count(*) as total'))
            ->groupBy('source_type')
            ->get();

        $labels = $irrigationData->pluck('source_type');
        $totals = $irrigationData->pluck('total');

        return view('irrigationsources.overview', compact('labels', 'totals'));
    }

    // Submit selected crops and techniques to farmer email
    public function submit(Request $request)
{
    // Validate the selected crops, techniques, and email
    $request->validate([
        'selected_techniques' => 'required|array',
        'selected_crops' => 'required|array',
        'farmer_email' => 'required|email',
        'farmer_name' => 'required|string',
    ]);

    // List of all crops and techniques, mapping their IDs to names
    $allCrops = [
        1 => 'Tomato',
        2 => 'Grape',
        3 => 'Strawberry',
        4 => 'Wheat',
        5 => 'Corn',
        6 => 'Pulses',
        7 => 'Vegetables',
        8 => 'Orchards',
        9 => 'Rice',
        10 => 'Sugarcane',
        11 => 'Cotton',
        12 => 'Lettuce',
        13 => 'Carrot',
        14 => 'Onion',
    ];

    $allTechniques = [
        1 => 'Drip Irrigation',
        2 => 'Sprinkler Irrigation',
        3 => 'Solar Irrigation',
        4 => 'Surface Irrigation',
        5 => 'Subsurface Irrigation',
    ];

    // Crop selection based on technique ID
    $cropsByTechnique = [
        1 => [1, 2, 3], // Drip Irrigation (Tomato, Grape, Strawberry)
        2 => [4, 5, 6], // Sprinkler Irrigation (Wheat, Corn, Pulses)
        3 => [7, 8, 9], // Solar Irrigation (Vegetables, Orchards, Rice)
        4 => [9, 10, 11], // Surface Irrigation (Rice, Sugarcane, Cotton)
        5 => [12, 13, 14], // Subsurface Irrigation (Lettuce, Carrot, Onion)
    ];

    // Prepare selected crops and techniques
    $selectedCrops = [];
    $selectedTechniques = [];

    // Extract selected crops based on the selected techniques
    foreach ($request->selected_techniques as $techniqueId) {
        if (isset($allTechniques[$techniqueId])) {
            $selectedTechniques[] = $allTechniques[$techniqueId];
            if (isset($cropsByTechnique[$techniqueId])) {
                // Get crops only for the selected technique
                foreach ($cropsByTechnique[$techniqueId] as $cropId) {
                    if (isset($allCrops[$cropId])) {
                        $selectedCrops[] = $allCrops[$cropId];
                    }
                }
            }
        }
    }

    // Get the farmer's details from the form
    $farmerName = $request->input('farmer_name');
    $farmerEmail = $request->input('farmer_email');

    // Send the irrigation recommendation email
    Mail::to($farmerEmail)->send(new IrrigationRecommendation($selectedCrops, $selectedTechniques, $farmerName, $farmerEmail));

    // Return with success message
    return redirect()->route('irrigationsources.index')->with('success', 'Recommendations have been sent to your email.');
}

}
