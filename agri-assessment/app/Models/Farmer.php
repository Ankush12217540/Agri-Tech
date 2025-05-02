<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'region_id'];

    // Define the relationship with the Region model
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Define the relationship with the LandHolding model
    public function landHolding()
    {
        return $this->hasOne(LandHolding::class, 'farmer_id');
    }

    // Define the relationship with the CroppingPattern model (optional, if exists)
    public function croppingPatterns()
    {
        return $this->hasMany(CroppingPattern::class, 'farmer_id');
    }

    // Accessor to retrieve the formatted land holding area
    public function getLandHoldingAreaAttribute()
    {
        return $this->landHolding ? number_format($this->landHolding->area, 2) : null;
    }

    // Method to get the farmer's status (active or incomplete)
    public function getStatusAttribute()
    {
        // Check if the farmer has land holding or cropping patterns (or any other critical data)
        if ($this->landHolding == null || $this->croppingPatterns->isEmpty()) {
            return '🔵 Data Incomplete';
        }
        return '🟢 Active Farmer';
    }
}
