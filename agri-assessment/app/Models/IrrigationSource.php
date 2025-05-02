<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrrigationSource extends Model
{
    protected $fillable = ['region_id', 'source_type'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
