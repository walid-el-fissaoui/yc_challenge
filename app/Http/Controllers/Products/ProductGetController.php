<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\Products\ProductGetService;

class ProductGetController extends Controller
{
  private ProductGetService $productGetService;
  private CategoryService $categoryService;

  public function __construct(ProductGetService $productGetService,CategoryService $categoryService) {
    $this->productGetService = $productGetService;
    $this->categoryService = $categoryService;
  }

  public function index() {
    $products = $this->productGetService->getAll();
    $categories = $this->categoryService->getAll();
    return view('pages.products.index',[
      'products' => $products,
      'categories' => $categories
    ]);
  }
}