<?php

namespace App\Models\Admin;
use App\Models\Categoryes as mCategoryes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        return Arr::first($this->categoryes->where('id',(int)$id)->get()->toArray());
    }

    public function storeCategory($data): array
    {
        DB::beginTransaction();

        try {
            $this->categoryes->fill($data);
            $this->categoryes->save();

            $data['id'] = $this->categoryes->id;

            DB::commit();

            return $data;

        } catch (\Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function updateCategory($data): array
    {
        DB::beginTransaction();

        try {
            $this->categoryes->where('id',$data['id'])->update($data);

            DB::commit();

            return $data;

        } catch (\Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function destroyCategory($id)
    {
      return  $this->categoryes->where('id',$id)->delete();
    }
}
