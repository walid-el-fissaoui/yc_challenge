<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductCategoryRepository;

class ProductCategoryService
{
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }
    
    public function attach(int $categoryId, int $productId)
    {
        $this->productCategoryRepository->attach($categoryId, $productId);
    }
}
