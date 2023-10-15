<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $categoryService;

    public function __construct(ProductService $productService,CategoryService $categoryService) {
        $productRepository = new ProductRepository();
        $categoryRepository = new CategoryRepository();
        $productService = new ProductService($productRepository);
        $categoryService = new CategoryService($categoryRepository);
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index() {
        $products = $this->productService->getAll();
        return view("pages.products.index",['products' => $products]);
    }

    public function filter(Request $request) {
        $params = $request->all();
        $products = $this->productService->getFiltered($params);
        return view("pages.products.index",['products' => $products]);
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
