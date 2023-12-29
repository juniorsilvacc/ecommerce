<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCategories()
    {
        $categories = $this->repository->getAllCategories();

        return $categories;
    }

    public function getCategory(int $categoryId)
    {
        $category = $this->repository->getCategory($categoryId);

        return $category;
    }

    public function createCategory(array $data)
    {
        $newCategory = $this->repository->createCategory($data);

        return $newCategory;
    }
}
