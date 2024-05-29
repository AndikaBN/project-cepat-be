<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
       /*
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('no_telp');
            $table->string('image_ktp')->nullable();
            $table->string('image_outlet')->nullable();
            $table->string('type');
            $table->integer('limit');
       */
        'user_id',
        'name',
        'no_telp',
        'image_ktp',
        'image_outlet',
        'type',
        'limit',
    ];
}
