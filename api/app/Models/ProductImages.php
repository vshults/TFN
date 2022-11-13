<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = [
        'url',
        'sort_order',
        'product_id'
    ];

    protected $table = 'product_images';
    public $timestamps = false;
}
