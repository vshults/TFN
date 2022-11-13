<?php

namespace App\Models\Admin;
use App\Models\Products as mProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Helpers\Image;

class Products extends Model
{
    public mProducts $products;
    public Image $image;

    public function __construct()
    {
        $this->products  = new mProducts();
        $this->image     = new Image();
    }

    public function index(): array
    {
        return $this->products->with(['images'])->get()->toArray() ?? [];
    }

    public function show($id): array
    {
        return Arr::first($this->products->with(['images'])->where('id',(int)$id)->get()->toArray());
    }

    public function storeProduct($data): array
    {
        DB::beginTransaction();

        try {
            $this->products->fill($data);
            $this->products->save();

            $data['id'] = $this->products->id;

            DB::commit();

            return $data;

        } catch (\Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function updateProduct($data): array
    {
        DB::beginTransaction();

        try {
            $this->products->where('id',$data['id'])->update($data);

            DB::commit();

            return $data;

        } catch (\Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function destroyProduct($id)
    {
       return  $this->products->where('id',$id)->delete();
    }

    public function uploadImage($data): array
    {
        if($data->hasFile('image') && !empty($data['id'])){

            try {
                $path = $this->image->saveLocal($data);

                DB::beginTransaction();

                $this->products->fill([]);
                $this->products->save([
                    'path' => $path,
                    'product_id' => $data['id']
                ]);

                DB::commit();

                return ['path' => $path];

            } catch (\Throwable $e) {
                dd($e->getMessage());
                DB::rollBack();
            }
        }else{
            return ['error' => 'Please select image'];
        }
    }
}
