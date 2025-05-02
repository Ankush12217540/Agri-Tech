<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IrrigationSource;

class IrrigationSourceSeeder extends Seeder
{
    public function run()
    {
        // Add a valid farmer_id, assuming you have farmers with IDs 1, 2, etc.
        IrrigationSource::create([
            'region_id' => 1, // North
            'source_type' => 'Canal',
            'farmer_id' => 1, // Example: Link this irrigation source to a farmer with ID 1
        ]);

        IrrigationSource::create([
            'region_id' => 2, // South
            'source_type' => 'Wells',
            'farmer_id' => 2, // Link to a farmer with ID 2
        ]);

        IrrigationSource::create([
            'region_id' => 3, // East
            'source_type' => 'Rainwater',
            'farmer_id' => 3, // Link to a farmer with ID 3
        ]);

        IrrigationSource::create([
            'region_id' => 4, // West
            'source_type' => 'Borewell',
            'farmer_id' => 4, // Link to a farmer with ID 4
        ]);
    }
}
