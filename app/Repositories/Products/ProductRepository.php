<?php

namespace App\Repositories\Products;

use App\Models\Product;
use Illuminate\Support\Arr;

class ProductRepository
{
    public function create(array $attributes): Product
    {
        $attributes = Arr::only($attributes, [
            Product::NAME_COLUMN, 
            Product::DESCRIPTION_COLUMN, 
            Product::PRICE_COLUMN, 
            Product::IMAGE_COLUMN
        ]);
        $product = Product::query()->create($attributes);

        return $product;
    }
}
