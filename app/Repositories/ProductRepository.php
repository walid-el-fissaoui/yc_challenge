<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Arr;

class ProductRepository
{
  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image']);
    return Product::query()->create($attributes);
  }
}
