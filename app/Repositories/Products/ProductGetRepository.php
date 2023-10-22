<?php

namespace App\Repositories\Products;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductGetRepository
{
  private $products;
  private ProductCategoryRepository $productCategoryRepository;
  public function __construct(ProductCategoryRepository $productCategoryRepository) {
    $this->productCategoryRepository = $productCategoryRepository;
    $this->products = Collect([]);
  }

  public function whereMinPrice(float $price) {
    $this->products = $this->products->where('price','>=',$price);
    return $this;
  }

  public function whereMaxPrice(float $price) {
    $this->products = $this->products->where('price','<=',$price);
    return $this;
  }

  public function whereCategory(int $category) {
    $products = Product::from("products as p")
    ->select("p.*")
    ->join("category_product as cp","cp.product_id","=",'p.id')
    ->where("cp.category_id",$category)
    ->get();
    $this->products = $products;
    return $this;
  }

  public function products(Collection $products = null) {
    if(isset($products)) {
      $this->products = $products;
    }
    else {
      $this->products = Product::query()->get();
    }
    return $this;
  }

  public function withCategoryName() {
    $this->products = $this->products->map(function($product) {
      $product['category'] = $this->productCategoryRepository->getCategoryName($product);
      return $product;
    });
    return $this;
  }

  public function getAll(): Collection {
    return $this->products;
  }
}