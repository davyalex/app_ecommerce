<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'region',
        'zone',
        'tarif',
        'parent_id',
        'region_id',
        'created_at',
        'updated_at'
    ];

    public function parent_region()
    {
        return $this->belongsTo(Delivery::class, 'region_id');
    }

    public function child_zone()
    {
        return $this->hasMany(Delivery::class, 'region_id');
    }


}

