<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\Products\ProductFilterService;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
  private ProductFilterService $productFilterService;
  private CategoryService $categoryService;

  public function __construct(ProductFilterService $productFilterService,CategoryService $categoryService) {
    $this->productFilterService = $productFilterService;
    $this->categoryService = $categoryService;
  }

  public function filter(Request $request) {
    $params = $request->all();
    $products = $this->productFilterService->getFiltered($params);
    $categories = $this->categoryService->getAll();
    return view("pages.products.index",['products' => $products,'categories' => $categories]);
  }
}