<?php

namespace App\Http\Controllers;

use App\Models\CroppingPattern;
use App\Models\Region;
use App\Models\Farmer;
use Illuminate\Http\Request;

class CroppingPatternController extends Controller
{
    /**
     * Display a listing of the cropping patterns.
     */
    public function index(Request $request)
    {
        $query = CroppingPattern::with('region', 'farmer');

        // Search by farmer name or crop name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('farmer', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('crop_name', 'like', "%{$search}%");
        }

        // Filter by season
        if ($request->filled('season')) {
            $query->where('season', $request->season);
        }

        $patterns = $query->paginate(10);

        return view('croppingpatterns.index', compact('patterns'));
    }

    /**
     * Show the form for creating a new cropping pattern.
     */
    public function create()
    {
        $regions = Region::all();
        $farmers = Farmer::all();
        return view('croppingpatterns.create', compact('regions', 'farmers'));
    }

    /**
     * Store a newly created cropping pattern in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'farmer_id' => 'required|exists:farmers,id',
            'crop_name' => 'required|string|max:255',
            'season' => 'required|string|max:50',
        ]);

        CroppingPattern::create($validated);

        return redirect()->route('croppingpatterns.index')
            ->with('success', 'Cropping pattern added successfully!');
    }
}
