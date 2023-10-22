<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductGetRepository;
use Illuminate\Support\Collection;

class ProductGetService
{
  private ProductGetRepository $productGetRepository;

  public function __construct(ProductGetRepository $productGetRepository) {
    $this->productGetRepository = $productGetRepository;
  }

  public function getAll(): Collection {
    return $this->productGetRepository->products()->withCategoryName()->getAll();
  }
}