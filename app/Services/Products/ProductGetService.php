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
    return $this->productGetRepository->products()->withCategory()->getAll();
  }

  public function getFiltered(array $params): Collection {
    $products = $this->productGetRepository->products()->getAll();
    if(isset($params['mip']))
    $products = $this->productGetRepository->products($products)->whereMinPrice($params["mip"])->withCategory()->getAll();
    if(isset($params['map']))
    $products = $this->productGetRepository->products($products)->whereMaxPrice($params["map"])->withCategory()->getAll();
    if(isset($params['cat']) && $params['cat'] != 0)
    $products = $this->productGetRepository->products($products)->whereCategory($params["cat"])->withCategory()->getAll();
    return $products;
  }

}