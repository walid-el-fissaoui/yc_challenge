<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductGetRepository;
use Illuminate\Support\Collection;

class ProductFilterService
{
  private ProductGetRepository $productGetRepository;

  public function __construct(ProductGetRepository $productGetRepository) {
    $this->productGetRepository = $productGetRepository;
  }

  public function getFiltered(array $params): Collection {
    $products = $this->productGetRepository->products()->getAll();
    
    if(isset($params['cat']) && $params['cat'] != 0) {
      $products = $this->productGetRepository->products($products)->whereCategory($params["cat"])->withCategoryName()->getAll();
    }
    return $products;
  }

}