<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Products\ProductFilterService;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    private ProductFilterService $productFilterService;

    public function __construct(ProductFilterService $productFilterService)
    {
        $this->productFilterService = $productFilterService;
    }

    public function filter(Request $request)
    {
        $params = $request->all();
        $products = $this->productFilterService->getFiltered($params);
        
        return response()->json(ProductResource::collection($products));
    }
}
