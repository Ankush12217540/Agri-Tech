<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandHolding extends Model
{
    // Allow mass assignment for the following fields
    protected $fillable = [
    'area',
    'ownership_type',
    'farmer_id',
    'region_id',
];

    // Define the relationship with the Farmer model
    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    // Define the relationship with the Region model
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Define the relationship with the IrrigationSource model
    public function irrigationSources()
    {
        return $this->hasMany(IrrigationSource::class, 'land_holding_id');
    }

    // Define the relationship with the CropPattern model
    public function cropPatterns()
    {
        return $this->hasMany(CropPattern::class, 'land_holding_id');
    }

    // Define the relationship with the Well model
    public function wells()
    {
        return $this->hasMany(Well::class, 'land_holding_id');
    }
}
