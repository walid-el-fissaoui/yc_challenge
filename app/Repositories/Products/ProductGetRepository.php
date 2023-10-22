<?php

namespace App\Repositories\Products;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductGetRepository
{
  private $products;

  public function __construct() {
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
    if(isset($product)) {
      $this->products = $products;
    }
    else {
      $this->products = Product::query()->get();
    }
    return $this;
  }

  public function withCategory() {
    $this->products = $this->products->map(function($product) {
      $result =  DB::select("SELECT c.name FROM categories c, category_product cp WHERE c.id = cp.category_id AND cp.product_id = ?",[$product->id]);
      if(count($result) > 0) {
        $product['category'] = $result[0]->name;
      }
      return $product;
    });
    return $this;
  }

  public function getAll(): Collection {
    return $this->products;
  }
}