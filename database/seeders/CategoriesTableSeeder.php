<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cName = "Без категории";

        $categories[] = [
            'name' => $cName,
            'code' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cName), '-')),
        ];

        for($i = 1; $i<=15; $i++){

            $cName = "Категория №".$i;

            $categories[] = [
                'name' => $cName,
                'code' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cName), '-')),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
