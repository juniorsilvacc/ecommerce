<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use App\Services\UploadImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $path = 'products';

    private $service;
    private $uploadImageService;

    public function __construct(ProductService $service, UploadImageService $uploadImage)
    {
        $this->service = $service;
        $this->uploadImageService = $uploadImage;
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $category_id = $request->input('category_id');

        $products = $this->service->getAllProducts($name, $category_id);

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
        $data = $request->validated();

        // Método para manipular o upload da imagem
        $uploadedImage = $this->uploadImageService->handleImageUpload($request);

        if ($uploadedImage !== null) {
            $data['image'] = $uploadedImage;
        }

        $newProduct = $this->service->createProduct($data);

        return new ProductResource($newProduct);
    }

    public function update(StoreUpdateProduct $request, $productId)
    {
        $data = $request->validated();

        $product = $this->service->getProduct($productId);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        // Método para manipular o upload da imagem
        $uploadedImage = $this->uploadImageService->handleImageUpload($request, $product->image);

        if ($uploadedImage !== null) {
            $data['image'] = $uploadedImage;
        }

        $product = $this->service->updateProduct($data, $productId);

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        return $this->service->destroyProduct($id);
    }
}
