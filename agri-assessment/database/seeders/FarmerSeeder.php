<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farmer;
use App\Models\Region;

class FarmerSeeder extends Seeder
{
    public function run()
    {
        // Ensure the regions 'North' and 'South' are available
        $northId = Region::where('name', 'North')->first()->id;
        $southId = Region::where('name', 'South')->first()->id;

        // Seed the Farmer table with region_id
        Farmer::create(['name' => 'Farmer 1', 'region_id' => $northId]);
        Farmer::create(['name' => 'Farmer 2', 'region_id' => $northId]);
        Farmer::create(['name' => 'Farmer 3', 'region_id' => $southId]);
        Farmer::create(['name' => 'Farmer 4', 'region_id' => $southId]);
    }
}
