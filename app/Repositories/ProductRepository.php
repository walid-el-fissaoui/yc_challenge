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

  public function getByPrice(float $min,float $max): Collection {
    return Product::whereBetween('price',[$min,$max])->get();
  }

  public function getWhenMinPrice(float $price): Collection {
    return Product::where('price','>=',$price)->get();
  }

  public function getWhenMaxPrice(float $price): Collection {
    return Product::where('price','<=',$price)->get();
  }

  public function products() {
    $this->products = Product::query()->get();
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
