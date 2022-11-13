<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Products extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $table = 'products';
    public $timestamps = true;

    public function category():HasOne
    {
        return $this->hasOne(Categoryes::class,'id','category_id');
    }

    public function images():HasMany
    {
        return $this->hasMany(ProductImages::class,'product_id','id');
    }
}
