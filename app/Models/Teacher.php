<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';

    protected $fillable = [
        'name',
        'email',
        'dni',
        'langs',
        'type',
        'phone',
        'modality',
        'disponibility'
    ];

    protected $hidden = [];

}
