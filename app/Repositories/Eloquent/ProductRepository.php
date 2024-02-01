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

    public function getAllProducts($name = null, $category_id = null, $perPage = 10)
    {
        $query = $this->model->with('category')->orderBy('created_at', 'ASC');

        if ($name !== null) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($category_id !== null) {
            $query->where('category_id', $category_id);
        }

        $products = $query->paginate($perPage);

        return $products;
    }

    public function getProduct(int $productId)
    {
        $product = $this->model->with('category')->find($productId);

        return $product;
    }

    public function createProduct(array $data)
    {
        $newProduct = $this->model->create($data);

        return $newProduct;
    }

    public function updateProduct(array $data, int $productId)
    {
        $product = $this->model->with('category')->findOrFail($productId);

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
