<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProductService
{
  private $productRepository;

  public function __construct(ProductRepository $productRepository) {
    $this->productRepository = $productRepository;
  }

  public function getAll(): Collection {
    return $this->productRepository->getAll();
  }

  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image']);
    $path = $attributes['image']->store("products");
    $attributes['image'] = $path;
    return $this->productRepository->create($attributes);
  }
}
