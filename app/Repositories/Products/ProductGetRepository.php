<?php

namespace App\Repositories\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductGetRepository
{
    private $products;
    private ProductCategoryRepository $productCategoryRepository;
    
    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->products = Collect([]);
    }

    public function whereCategory(int $categoryId)
    {
        $query = sprintf(
            "SELECT p.%s FROM products p INNER JOIN category_product cp ON cp.%s = p.%s WHERE cp.%s = ?", 
            Product::ID_COLUMN, 
            CategoryProduct::PRODUCT_ID_COLUMN, 
            Product::ID_COLUMN, 
            CategoryProduct::CATEGORY_ID_COLUMN
        );
        $productsIdList = DB::SELECT($query, [$categoryId]);

        $this->products = $this->products->filter(function (Product $product) use ($productsIdList) {
            foreach ($productsIdList as $object) {
                if ($object->{Product::ID_COLUMN} === $product->getId()) {

                    return true;
                }
            }
        });

        return $this;
    }

    public function products(Collection $products = null)
    {
        if (isset($products)) {
            $this->products = $products;
        } else {
            $this->products = Product::query()->get();
        }

        return $this;
    }

    public function withCategoryName()
    {
        $this->products = $this->products->map(function ($product) {
            $product[Product::CATEGORY_COLUMN] = $this->productCategoryRepository->getCategoryName($product);
            
            return $product;
        });

        return $this;
    }

    public function getAll(): Collection
    {
        return $this->products;
    }
}
