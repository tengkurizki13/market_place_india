<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catagory;

class CatagoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catagoryRecords = [
            [
                'id'=> 1,
                'parent_id' => 0,
                'section_id' => 1,
                'catagory_name' => 'Men',
                'catagory_image' => '',
                'catagory_discount' => 0,
                'description' => '',
                'url' => 'men',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 0
            ],
            [
                'id'=> 2,
                'parent_id' => 0,
                'section_id' => 1,
                'catagory_name' => 'Women',
                'catagory_image' => '',
                'catagory_discount' => 0,
                'description' => '',
                'url' => 'women',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 0

            ],
            [
                'id'=> 3,
                'parent_id' => 0,
                'section_id' => 1,
                'catagory_name' => 'Kids',
                'catagory_image' => '',
                'catagory_discount' => 0,
                'description' => '',
                'url' => 'kids',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 0
            ]
        ];
        Catagory::insert($catagoryRecords);
    }
}
