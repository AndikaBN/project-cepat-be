<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'day',
        'status',
        'latitude',
        'longitude',
        'outlet_id',
        'outlet_name',
    ];
}
