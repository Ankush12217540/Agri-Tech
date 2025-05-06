<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    protected $fillable = ['land_holding_id', 'depth', 'type'];

    public function landHolding()

    
    {
        return $this->belongsTo(LandHolding::class);
    }
}
