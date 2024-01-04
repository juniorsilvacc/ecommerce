<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->getAllProducts();

        return ProductResource::collection($products);
    }

    public function show($productId)
    {
        $product = $this->service->getProduct($productId);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return new ProductResource($product);
    }

    public function store(StoreUpdateProduct $request)
    {
        $newProduct = $this->service->createProduct($request->validated());

        return new ProductResource($newProduct);
    }

    public function update(StoreUpdateProduct $request, $productId)
    {
        $product = $this->service->updateProduct($request->validated(), $productId);

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        return $this->service->destroyProduct($id);
    }
}
