<?php

namespace App\Repositories\Products;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
  public function attach(int $categoryId, int $productId) {
    $query = sprintf("INSERT INTO category_product(%s,%s) VALUES(?,?);",CategoryProduct::PRODUCT_ID_COLUMN,CategoryProduct::CATEGORY_ID_COLUMN);
    DB::insert($query,[$productId,$categoryId]);
  }
}