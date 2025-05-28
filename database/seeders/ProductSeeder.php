<?php

namespace Database\Seeders;

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
        Product::create([
            'title'=>'Produto exemplo Produto exemplo Produto exemplo',
            'price'=>'20.05',
            'quantity'=>'3',
            'category_id'=>'1',
            'brand_id'=>'1',
            'description'=>' descrição descrição descrição descrição descrição descrição',

        ]);
    }
}
