<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Products as Products;
use App\Models\Admin\Categoryes as Categoryes;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public Products $model;
    public Categoryes $categoryes;

    public function __construct()
    {
        $this->model       = new Products();
        $this->categoryes  = new Categoryes();
    }

    public function index():JsonResponse
    {
        return response()->json($this->model->index());
    }

    public function show(Request $request):JsonResponse
    {
        try {
            return response()->json($this->model->show($request['id']));
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Страница не найдена'], 404);
        }
    }

    public function getCategoryes():JsonResponse
    {
        return response()->json($this->categoryes->index());
    }

    public function store(Request $request):JsonResponse
    {
        request()->validate([
            'name'         => 'required',
            'category_id'  => 'required',
        ]);

        try {
            return response()->json($this->model->storeProduct($request->all()));
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request):JsonResponse
    {
        request()->validate([
            'name'         => 'required',
            'category_id'  => 'required',
        ]);

        try {
            return response()->json($this->model->updateProduct($request->all()));
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(Request $request):JsonResponse
    {
        try {
            $this->model->destroyProduct($request['id']);
            return response()->json(['message' => 'Продукт успешно удален']);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function uploadImage(Request $request):JsonResponse
    {
        request()->validate([
            'image' => 'mimes:jpg,bmp,png|max:1999'
        ]);

        try {
            return response()->json($this->model->uploadImage($request));
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
