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
    $products = $this->productRepository->products()->getAll();
    if(isset($params['mip']))
    $products = $this->productRepository->products($products)->whereMinPrice($params["mip"])->withCategory()->getAll();
    if(isset($params['map']))
    $products = $this->productRepository->products($products)->whereMaxPrice($params["map"])->withCategory()->getAll();
    if(isset($params['cat']) && $params['cat'] != 0)
    $products = $this->productRepository->products($products)->whereCategory($params["cat"])->withCategory()->getAll();
    return $products;
  }

  public function create(array $attributes): Product {
    $attributes = Arr::only($attributes,['name','description','price','image','category']);
    $path = (is_string($attributes['image'])) ? $attributes['image'] : $attributes['image']->store("products");
    $attributes['image'] = $path;
    return $this->productRepository->create($attributes);
  }
}
