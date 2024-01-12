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

    public function getAllCategories($name = null)
    {
        $categories = $this->repository->getAllCategories($name);

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

    public function updateCategory(array $data, int $categoryId)
    {
        $category = $this->repository->updateCategory($data, $categoryId);

        return $category;
    }

    public function destroyCategory(int $id)
    {
        $category = $this->repository->destroyCategory($id);

        return $category;
    }
}
