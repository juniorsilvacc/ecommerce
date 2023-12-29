<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAllCategories();

        return CategoryResource::collection($categories);
    }

    public function show($categoryId)
    {
        $category = $this->service->getCategory($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return new CategoryResource($category);
    }

    public function store(StoreUpdateCategory $request)
    {
        $newCategory = $this->service->createCategory($request->validated());

        return new CategoryResource($newCategory);
    }
}
