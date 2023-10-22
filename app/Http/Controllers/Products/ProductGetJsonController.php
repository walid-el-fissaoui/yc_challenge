<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Products\ProductGetService;

class ProductGetJsonController extends Controller
{
  private ProductGetService $productGetService;

  public function __construct(ProductGetService $productGetService) {
    $this->productGetService = $productGetService;
  }

  public function getJSON() {
    $products = $this->productGetService->getAll();
    return response()->json(ProductResource::collection($products));
  }
}