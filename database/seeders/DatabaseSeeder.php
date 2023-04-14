<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $quantityUsers = 1000;
        $quantityCategories = 30;
        $quantityProducts = 1000;
        $quantityTransactions = 1000;

        User::factory($quantityUsers)->create();
        Category::factory($quantityCategories)->create();

        Product::factory($quantityProducts)->create()->each(
            function ($product) {
                 // con esto indicamos que solo queremos el id
                $categories =   Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );

        Transaction::factory($quantityTransactions)->create();
    }
}
