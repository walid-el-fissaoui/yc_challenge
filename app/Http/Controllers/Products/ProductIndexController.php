<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class ProductIndexController extends Controller
{
  private CategoryService $categoryService;

  public function __construct(CategoryService $categoryService) {
    $this->categoryService = $categoryService;
  }

  public function index() {
    $categories = $this->categoryService->getAll();
    return view('pages.products.index',[
      'categories' => $categories
    ]);
  }
}