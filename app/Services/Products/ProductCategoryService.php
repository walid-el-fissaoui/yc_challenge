<?php

namespace App\Services\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Repositories\Products\ProductCategoryRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Arr;

class ProductCategoryService
{
  private ProductCategoryRepository $productCategoryRepository;
  public function __construct(ProductCategoryRepository $productCategoryRepository) {
    $this->productCategoryRepository = $productCategoryRepository;
  }
  public function attach(int $categoryId, int $productId) {
    $this->productCategoryRepository->attach($categoryId,$productId);
  }
}