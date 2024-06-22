<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'no_telp',
        'image_ktp',
        'image_outlet',
        'type',
        'limit',
    ];

    // users belongsto user role sales
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
