<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    protected $fillable = [
        'name',
        'description',
        'status',
        'max_students',
        'date',
        'time_start',
        'time_end',
        'teacher_id',
        'material'
    ];

    protected $hidden = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
