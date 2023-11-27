<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rent';

    protected $fillable = [
        'product_id',
        'clients',
        'date',
        'time_start',
        'time_end',
        'status',
        'price'
    ];

    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
