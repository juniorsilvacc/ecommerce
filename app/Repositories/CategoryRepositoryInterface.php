<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategory(int $categoryId);

    public function createCategory(array $data);
}
