<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:new {name} {description} {price}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create new product';

    private $productService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $productRepository = new ProductRepository();
        $productService = new ProductService($productRepository);
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $attributes = Arr::except($this->arguments(),["command"]);
        $attributes['image'] = "";
        $product = $this->productService->create($attributes);
        dd($product);
        $this->info('Your product has beend created succesfully.');
    }
}
