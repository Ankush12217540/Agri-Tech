<?php
namespace App\Http\Controllers;

use App\Models\CropPattern;
use Illuminate\Http\Request;

class CropPatternController extends Controller
{
    public function index() {
        $cropPatterns = CropPattern::all();
        return view('croppattern.index', compact('cropPatterns'));
    }

    public function create() {
        return view('croppattern.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'crop_type' => 'required|string|max:255',
        ]);

        CropPattern::create($validated);

        return redirect()->route('croppattern.index')->with('success', 'Cropping Pattern added successfully!');
    }
}
