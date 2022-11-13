<?php

namespace App\Models\Catalog;

use App\Models\Products as mProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Products extends Model
{
    public mProducts $products;

    public function __construct()
    {
        $this->products  = new mProducts();
    }

    public function index(): array
    {
        return $this->products->with(['images'])->get()->toArray() ?? [];
    }

    public function show($id): array
    {
        return Arr::first($this->products->with(['images'])->where('id',(int)$id)->get()->toArray());
    }
}
