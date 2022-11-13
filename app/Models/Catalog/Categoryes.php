<?php

namespace App\Models\Catalog;

use App\Models\Categoryes as mCategoryes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Categoryes extends Model
{
    public mCategoryes $categoryes;

    public function __construct()
    {
        $this->categoryes  = new mCategoryes();
    }

    public function index(): array
    {
        return $this->categoryes->get()->toArray() ?? [];
    }

    public function show($id): array
    {
        return Arr::first($this->categoryes->with('products')->where('id',(int)$id)->get()->toArray());
    }
}
