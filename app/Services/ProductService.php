<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllProducts()
    {
        $products = $this->repository->getAllProducts();

        return $products;
    }

    public function getProduct(int $productId)
    {
        $product = $this->repository->getProduct($productId);

        return $product;
    }

    public function createProduct(array $data)
    {
        $newProduct = $this->repository->createProduct($data);

        return $newProduct;
    }

    public function updateProduct(array $data, int $productId)
    {
        $product = $this->repository->updateProduct($data, $productId);

        return $product;
    }

    public function destroyProduct(int $id)
    {
        $product = $this->repository->destroyProduct($id);

        return $product;
    }
}
