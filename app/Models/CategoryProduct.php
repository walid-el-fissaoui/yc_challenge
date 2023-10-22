<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
  protected $table = 'category_product';

  public const ID_COLUMN = "id";
  public const CATEGORY_ID_COLUMN = "category_id";
  public const PRODUCT_ID_COLUMN = "product_id";

  public function getId() {
    return $this->getAttribute(self::ID_COLUMN);
  }

  public function getCategoryId() {
    return $this->getAttribute(self::CATEGORY_ID_COLUMN);
  }

  public function getProductId() {
    return $this->getAttribute(self::PRODUCT_ID_COLUMN);
  }
}