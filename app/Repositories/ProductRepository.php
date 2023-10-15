<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository
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

  public function create(array $attributes): Product {
    $category = $attributes['category'];
    $attributes = Arr::only($attributes,['name','description','price','image']);
    $product = Product::query()->create($attributes);
    $this->appendToCategory($category,$product);
    return $product;
  }

  public function appendToCategory(int $category, Product $product) {
    DB::insert("INSERT INTO category_product(product_id,category_id) VALUES (?,?)",[$product->id,$category]);
  }
}
