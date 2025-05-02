<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CroppingPattern extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'farmer_id', 'crop_name', 'season'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
