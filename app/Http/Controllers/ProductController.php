<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create() {
        return view("pages.products.create");
    }
    public function store(ProductRequest $request) {
        $validatedRequest = $request->validated();
        dd($validatedRequest);
    }
}
