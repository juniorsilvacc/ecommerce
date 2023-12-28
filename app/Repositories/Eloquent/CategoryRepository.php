<?php

namespace App\Repositories\Eloquent;

use App\Http\Resources\CategoryResource;
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

        return CategoryResource::collection($categories);
    }
}
