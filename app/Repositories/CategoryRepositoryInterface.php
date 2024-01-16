<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllCategories($name = null, $perPage = 10);

    public function getCategory(int $categoryId);

    public function createCategory(array $data);

    public function updateCategory(array $data, int $categoryId);

    public function destroyCategory(int $id);
}
