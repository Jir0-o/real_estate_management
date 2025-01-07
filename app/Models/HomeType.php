<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'is_active',
        'created_at',
        'updated_at',
    ];
}
