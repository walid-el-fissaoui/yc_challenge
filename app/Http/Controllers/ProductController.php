<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;
    private CategoryService $categoryService;

    public function __construct(ProductService $productService,CategoryService $categoryService) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index() {
        $products = $this->productService->getAll();
        $categories = $this->categoryService->getAll();
        return view("pages.products.index",['products' => $products,'categories' => $categories]);
    }

    public function filter(Request $request) {
        $params = $request->all();
        $products = $this->productService->getFiltered($params);
        $categories = $this->categoryService->getAll();
        return view("pages.products.index",['products' => $products,'categories' => $categories]);
    }

    public function create() {
        $categories = $this->categoryService->getAll();
        return view("pages.products.create",['categories' => $categories]);
    }

    public function store(ProductRequest $request) {
        $validatedRequest = $request->validated();
        $product = $this->productService->create($validatedRequest);
        return redirect()->back()->with("status","Your product has been added successfully.");
    }
}
