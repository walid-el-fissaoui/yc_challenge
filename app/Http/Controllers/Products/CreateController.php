<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CreateController extends Controller
{
  private CategoryService $categoryService;
  public function __construct(CategoryService $categoryService) {
    $this->categoryService = $categoryService;
  }
  public function create() {
    $categories = $this->categoryService->getAll();
    return view("pages.products.create",['categories' => $categories]);
  }
}