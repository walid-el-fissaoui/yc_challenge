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

  public function getByPrice(float $min,float $max): Collection {
    return Product::whereBetween('price',[$min,$max])->get();
  }

  public function getWhenMinPrice(float $price): Collection {
    return Product::where('price','>=',$price)->get();
  }

  public function getWhenMaxPrice(float $price): Collection {
    return Product::where('price','<=',$price)->get();
  }

  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image']);
    return Product::query()->create($attributes);
  }
}
