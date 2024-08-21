<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'day',
        'status',
        'latitude',
        'longitude',
        'data_otlets_id',
        'outlet_name',
    ];

    public function data_otlets()
    {
        return $this->belongsTo(DataOtlet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'data_otlets_id', 'data_otlets_id');
    }
    
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'user_id', 'user_id');
    }
}
