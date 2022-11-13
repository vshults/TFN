<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categoryes as Categoryes;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryesController extends Controller
{
    public Categoryes $model;

    public function __construct()
    {
        $this->model   = new Categoryes();
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

    public function store(Request $request):JsonResponse
    {
        request()->validate([
            'name'    => 'required',
        ]);

        try {
            return response()->json($this->model->storeCategory($request->all()));
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request):JsonResponse
    {
        request()->validate([
            'name'    => 'required',
        ]);

        try {
            return response()->json($this->model->updateCategory($request->all()));
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(Request $request):JsonResponse
    {
        try {
            $this->model->destroyCategory($request['id']);
            return response()->json(['message' => 'Категория успешно удалена']);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
