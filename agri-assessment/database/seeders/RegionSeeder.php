<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        Region::create(['name' => 'North']);
        Region::create(['name' => 'South']);
    }
}
