<?php

namespace App\Services\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Arr;

class ProductService
{
    private ProductRepository $productRepository;
    private ProductCategoryService $productCategoryService;

    public function __construct(ProductRepository $productRepository, ProductCategoryService $productCategoryService)
    {
        $this->productRepository = $productRepository;
        $this->productCategoryService = $productCategoryService;
    }

    public function create(array $attributes): Product
    {
        $categoryId = $attributes[CategoryProduct::CATEGORY_ID_COLUMN];
        $attributes = Arr::only($attributes, [
            Product::NAME_COLUMN, 
            Product::DESCRIPTION_COLUMN, 
            Product::PRICE_COLUMN, 
            Product::IMAGE_COLUMN
        ]);
        $imagePath = (is_string($attributes[Product::IMAGE_COLUMN])) ? $attributes[Product::IMAGE_COLUMN] : $attributes[Product::IMAGE_COLUMN]->store("products");
        $attributes[Product::IMAGE_COLUMN] = $imagePath;
        $product = $this->productRepository->create($attributes);

        $this->productCategoryService->attach($categoryId, $product->getId());

        return $product;
    }
}
