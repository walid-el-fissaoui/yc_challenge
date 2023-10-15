<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService) {
        $productRepository = new ProductRepository();
        $productService = new ProductService($productRepository);
        $this->productService = $productService;
    }

    public function index() {
        $products = $this->productService->getAll();
        return view("pages.products.index",['products' => $products]);
    }

    public function create() {
        return view("pages.products.create");
    }

    public function store(ProductRequest $request) {
        $validatedRequest = $request->validated();
        $product = $this->productService->create($validatedRequest);
        return redirect()->back()->with("status","Your product has been added successfully.");
    }
}
