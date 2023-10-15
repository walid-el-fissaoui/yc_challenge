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
    return $this->productRepository->products()->withCategory()->getAll();
  }

  public function getFiltered(array $params): Collection {
    if(isset($params['mip']) && isset($params['map'])) {
      $products = $this->productRepository->getByPrice($params["mip"],$params["map"]);
    }
    else if(isset($params['mip']) && !isset($params['map']))
    {
      $products = $this->productRepository->getWhenMinPrice($params["mip"]);
    }
    else if(isset($params['map']) && !isset($params['mip']))
    {
      $products = $this->productRepository->getWhenMaxPrice($params["map"]);
    }
    else {
      $products = $this->productRepository->getAll();
    }
    return $products;
  }

  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image','category']);
    $path = (is_string($attributes['image'])) ? $attributes['image'] : $attributes['image']->store("products");
    $attributes['image'] = $path;
    return $this->productRepository->create($attributes);
  }
}
