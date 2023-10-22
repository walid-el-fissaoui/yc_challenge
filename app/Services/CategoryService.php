<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CategoryService
{

  private CategoryRepository $categoryRepository;

  public function __construct(CategoryRepository $categoryRepository) {
    $this->categoryRepository = $categoryRepository;
  }

  public function getAll(): Collection {
    return $this->categoryRepository->getAll();
  }
}