<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'beds',
        'baths',
        'sq_ft',
        'year_build',
        'price_per_sqft',
        'location',
        'home_type',
        'buy_type',
        'city',
        'more_info',
        'agent_name',
        'property_image',
        'is_active',
        'status',
        'created_at',
        'updated_at',
    ];
}
