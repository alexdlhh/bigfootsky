<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asigned extends Model
{
    protected $table = 'asigned';

    protected $fillable = [
        'client_id',
        'teacher_id',
        'course_id',
        'particular_id',
        'type'
    ];

    protected $hidden = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function particular()
    {
        return $this->belongsTo(Particular::class, 'particular_id');
    }
}
