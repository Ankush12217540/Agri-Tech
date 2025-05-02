<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropPattern extends Model
{
    protected $fillable = ['land_holding_id', 'crop_name', 'season'];

    public function landHolding()
    {
        return $this->belongsTo(LandHolding::class);
    }
}
