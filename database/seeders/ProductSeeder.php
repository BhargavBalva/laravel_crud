<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Laptop', 'price' => 45000.00],
            ['name' => 'Mouse', 'price' => 500.00],
            ['name' => 'Keyboard', 'price' => 900.00],
            ['name' => 'Monitor', 'price' => 8500.00],
        ]);
    }
}
