<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    protected $table = 'particular';

    protected $fillable = [
        'name',
        'description',
        'status',
        'max_students',
        'date',
        'time_start',
        'time_end',
        'teacher_id'
    ];

    protected $hidden = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
