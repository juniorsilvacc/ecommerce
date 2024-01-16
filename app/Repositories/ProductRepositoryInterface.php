<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAllProducts($name = null, $perPage = 10);

    public function getProduct(int $productId);

    public function createProduct(array $data);

    public function updateProduct(array $data, int $productId);

    public function destroyProduct(int $id);
}
