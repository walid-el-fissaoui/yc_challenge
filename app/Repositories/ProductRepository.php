<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProductRepository
{

  public function getAll(): Collection {
    return Product::query()->get();
  }

  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image']);
    return Product::query()->create($attributes);
  }
}
