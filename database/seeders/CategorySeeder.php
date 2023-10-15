<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository) {
        $categoryRepository = new CategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Collect(['Cat1','Cat2','Cat3','Cat4']);
        $categories->each(function($category) {
            $this->categoryRepository->create(['name' => $category]);
        });
    }
}
