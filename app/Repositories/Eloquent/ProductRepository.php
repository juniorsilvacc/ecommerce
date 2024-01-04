<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAllProducts()
    {
        $products = $this->model->orderBy('created_at', 'ASC')->get();

        return $products;
    }

    public function getProduct(int $productId)
    {
        $product = $this->model->where('id', $productId)->first();

        return $product;
    }

    public function createProduct(array $data)
    {
        $newProduct = $this->model->create($data);

        return $newProduct;
    }

    public function updateProduct(array $data, int $productId)
    {
        $product = $this->model->findOrFail($productId);

        $product->update($data);

        return $product;
    }

    public function destroyProduct(int $id)
    {
        $product = $this->model->where('id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();
    }
}
