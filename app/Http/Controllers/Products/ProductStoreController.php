<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Services\Products\ProductService;

class ProductStoreController extends Controller
{
  private ProductService $productService;
  public function __construct(ProductService $productService) {
    $this->productService = $productService;
  }
  public function store(ProductRequest $request) {
    $validatedRequest = $request->validated();
    $attributes = array(
      Product::NAME_COLUMN => $validatedRequest['name'],
      Product::DESCRIPTION_COLUMN => $validatedRequest['description'],
      Product::PRICE_COLUMN => $validatedRequest['price'],
      Product::IMAGE_COLUMN => $validatedRequest['image'],
      CategoryProduct::CATEGORY_ID_COLUMN => $validatedRequest['category']
    );
    $product = $this->productService->create($attributes);
    return redirect()->back()->with("status","Your product has been added successfully.");
  }
}