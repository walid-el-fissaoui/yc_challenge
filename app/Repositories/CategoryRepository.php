<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CategoryRepository
{

  public function getAll(): Collection {
    return Category::query()->get();
  }

  public function create(array $attributes): Category {
    $attributes = Arr::only($attributes,['name']);
    return Category::query()->create($attributes);
  }
}