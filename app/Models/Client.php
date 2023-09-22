<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $fillable = [
        'name',
        'surname',
        'dni',
        'address',
        'phone',
        'height',
        'weight',
        'shoe_size',
        'ski_level',
        'snow_level',
        'snow_front',
        'birthdate'
    ];

    protected $hidden = [];
}
