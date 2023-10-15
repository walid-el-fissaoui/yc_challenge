<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepository;
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
    protected $signature = 'product:new {name} {description} {price} {image}';

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
        try {
            $path = Storage::putFile("products",$attributes['image']);
        } catch (\Throwable $th) {
            $this->error('Impossible to find your file');
        }
        if(isset($path)) {
            $attributes['image'] = $path;
            $product = $this->productService->create($attributes);
            $this->info('Your product has beend created succesfully.');
        }
    }
}
