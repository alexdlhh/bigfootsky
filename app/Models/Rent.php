<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rent';

    protected $fillable = [
        'teacher_id',
        'client_id',
        'date',
        'time_start',
        'time_end',
        'status'
    ];

    protected $hidden = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
