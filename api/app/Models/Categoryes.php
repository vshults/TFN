<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Categoryes extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'categoryes';
    public $timestamps = false;

    public function products():HasMany
    {
        return $this->hasMany(Products::class,'category_id','id');
    }
}
