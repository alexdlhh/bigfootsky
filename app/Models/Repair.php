<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table = 'repair';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];
}
