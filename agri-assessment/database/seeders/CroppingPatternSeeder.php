<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CroppingPattern;

class CroppingPatternSeeder extends Seeder
{
    public function run()
    {
        CroppingPattern::create([
            'region_id' => 1,
            'farmer_id' => 1,
            'crop_name' => 'Wheat',
            'season' => 'Rabi'
        ]);

        CroppingPattern::create([
            'region_id' => 2,
            'farmer_id' => 2,
            'crop_name' => 'Paddy',
            'season' => 'Kharif'
        ]);

        CroppingPattern::create([
            'region_id' => 3,
            'farmer_id' => 3,
            'crop_name' => 'Maize',
            'season' => 'Zaid'
        ]);
    }
}
