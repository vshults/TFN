<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Categoryes as Categoryes;
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
}
