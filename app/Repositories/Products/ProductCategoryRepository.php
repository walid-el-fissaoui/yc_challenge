<?php

namespace App\Repositories\Products;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
  public function attach(int $categoryId, int $productId) {
    $query = sprintf("INSERT INTO category_product(%s,%s) VALUES(?,?);",CategoryProduct::PRODUCT_ID_COLUMN,CategoryProduct::CATEGORY_ID_COLUMN);
    DB::insert($query,[$productId,$categoryId]);
  }

  public function getCategoryName(Product $product) {
    $query = sprintf("SELECT c.%s FROM categories c, category_product cp WHERE c.%s = cp.%s AND cp.%s = ?",Category::NAME_COLUMN,Category::ID_COLUMN,CategoryProduct::ID_COLUMN,CategoryProduct::PRODUCT_ID_COLUMN);
    $categoryName = DB::select($query,[$product->getId()]);
    if(count($categoryName) > 0) {
      return $categoryName[0]->{Category::NAME_COLUMN};
    }
    return null;
  }
}