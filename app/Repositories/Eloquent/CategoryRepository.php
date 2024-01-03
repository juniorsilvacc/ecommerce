<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAllCategories()
    {
        $categories = $this->model->orderBy('created_at', 'ASC')->get();

        return $categories;
    }

    public function getCategory(int $categoryId)
    {
        $category = $this->model->where('id', $categoryId)->first();

        return $category;
    }

    public function createCategory(array $data)
    {
        $newCategory = $this->model->create($data);

        return $newCategory;
    }

    public function updateCategory(array $data, int $categoryId)
    {
        $category = $this->model->findOrFail($categoryId);

        $category->update($data);

        return $category;
    }

    public function destroyCategory(int $id)
    {
        $category = $this->model->where('id', $id)->first();

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        $category->delete();
    }
}
