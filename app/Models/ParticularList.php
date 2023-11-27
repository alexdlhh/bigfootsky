<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticularList extends Model
{
    protected $table = 'particular_list';

    protected $fillable = [
        'id_client',
        'id_product',
        'product'
    ];

    protected $hidden = [];
}
