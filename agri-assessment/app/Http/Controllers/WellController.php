<?php
namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    public function index() {
        $wells = Well::all();
        return view('well.index', compact('wells'));
    }

    public function create() {
        return view('well.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'depth' => 'required|numeric|min:1',
        ]);

        Well::create($validated);

        return redirect()->route('well.index')->with('success', 'Well Depth data added successfully!');
    }
}
