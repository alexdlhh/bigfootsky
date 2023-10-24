<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborators extends Model
{
    protected $table = 'colaborators';

    protected $fillable = [
        'name',
        'surname',
        'dni',
        'address',
        'email',
        'phone',
        'height',
        'weight',
        'shoe_size',
        'ski_level',
        'snow_level',
        'snow_front',
        'birthdate',
        'colaborators_id',
    ];

    protected $hidden = [];
}
