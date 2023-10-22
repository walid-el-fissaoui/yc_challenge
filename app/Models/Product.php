<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
  public const ID_COLUMN = "id";
  public const NAME_COLUMN = "name";
  public const DESCRIPTION_COLUMN = "description";
  public const PRICE_COLUMN = "price";
  public const IMAGE_COLUMN = "image";

  protected $fillable = [
    self::ID_COLUMN,
    self::NAME_COLUMN,
    self::DESCRIPTION_COLUMN,
    self::PRICE_COLUMN,
    self::IMAGE_COLUMN
  ];

  public function getId()
  {
    return $this->getAttribute(self::ID_COLUMN);
  }

  public function getName() {
    return $this->getAttribute(self::NAME_COLUMN);
  }

  public function getDescription() {
    return $this->getAttribute(self::DESCRIPTION_COLUMN);
  }

  public function getPrice() {
    return $this->getAttribute(self::PRICE_COLUMN);
  }

  public function getImage() {
    return Storage::url($this->getAttribute(self::IMAGE_COLUMN));
  }
}
