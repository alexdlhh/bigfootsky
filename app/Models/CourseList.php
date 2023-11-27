<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseList extends Model
{
    protected $table = 'course_list';

    protected $fillable = [
        'id_client',
        'id_product',
        'product'
    ];

    protected $hidden = [];
}
