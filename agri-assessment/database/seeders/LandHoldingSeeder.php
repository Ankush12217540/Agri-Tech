<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandHolding;
use App\Models\Region;

class LandHoldingSeeder extends Seeder
{
    public function run()
    {
        LandHolding::create([
            'farmer_id' => 1,
            'region_id' => Region::where('name', 'North')->first()->id,
            'area' => 120,
            'land_type' => 'Irrigated'  // You can specify 'land_type' here
        ]);
        
        LandHolding::create([
            'farmer_id' => 2,
            'region_id' => Region::where('name', 'South')->first()->id,
            'area' => 80,
            'land_type' => 'Non-Irrigated'  // You can specify 'land_type' here
        ]);
        
        LandHolding::create([
            'farmer_id' => 3,
            'region_id' => Region::where('name', 'East')->first()->id,
            'area' => 150,
            'land_type' => 'Irrigated'  // You can specify 'land_type' here
        ]);
        
        LandHolding::create([
            'farmer_id' => 4,
            'region_id' => Region::where('name', 'West')->first()->id,
            'area' => 100,
            'land_type' => 'Non-Irrigated'  // You can specify 'land_type' here
        ]);
    }
}
