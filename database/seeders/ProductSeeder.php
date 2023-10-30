<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(30)
            ->sequence(
                [
                'category_id' => Category::factory()->create()->id
            ], [
                'category_id' => Category::factory()->create()->id
            ], [
                'category_id' => Category::factory()->create()->id
            ]
            )
            ->create();
    }
}
