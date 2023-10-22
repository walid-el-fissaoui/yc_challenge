<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'product:new';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command to create new product';

  private ProductService $productService;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(ProductService $productService)
  {
    parent::__construct();
    $this->productService = $productService;
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $name = $this->ask("Please enter product's name");

    while (empty($name)) {
      $this->error("Product's name cannot be empty.");
      $name = $this->ask("Please enter product's name");
    }

    $description = $this->ask("Please enter product's description");

    while (empty($description)) {
      $this->error("Product's description cannot be empty.");
      $description = $this->ask("Please enter product's description");
    }

    $price = $this->ask("Please enter product's price");

    while (empty($price)) {
      $this->error("Product's price cannot be empty.");
      $price = $this->ask("Please enter product's price");
    }

    $image = $this->ask("Please enter the path of the product's image");

    while (empty($image)) {
      $this->error("Product's image cannot be empty.");
      $image = $this->ask("Please enter the path of the product's image");
    }

    try {
      $imagePath = Storage::putFile("products", $image);
    } catch (\Throwable $th) {
      $this->error('Impossible to find your file');
    }
    
    if(isset($imagePath)) {
      $attributes = array(
        Product::NAME_COLUMN => $name,
        Product::DESCRIPTION_COLUMN => $description,
        Product::PRICE_COLUMN => $price,
        Product::IMAGE_COLUMN => $imagePath
      );
      $product = $this->productService->create($attributes);
      $this->info('Your product has beend created succesfully.');
    }

  }
}
