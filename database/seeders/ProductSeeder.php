<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Jamur Tiram 1kg',
                'price' => 30000.00,
                'description' => 'Jamur Tiram kemasan 1kg',
                'tags' => 'jamur',
                'category_id' => 1,
            ],
            [
                'name' => 'Jamur Tiram 1/2kg',
                'price' => 15000.00,
                'description' => 'Jamur Tiram kemasan 1/2kg',
                'tags' => 'jamur',
                'category_id' => 1,
            ]
        ]);
    }
}
