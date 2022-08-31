<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
                'id'=> 2,
                'name' => 'Rizki',
                'type' => 'vendor',
                'vendor_id' => 1,
                'mobile' => '082122121',
                'email' => 'rizki@gmail.com',
                'password' => bcrypt('12345'),
                'image' => '',
                'status' => ''
            ]
        ];
        Admin::insert($adminRecords);
    }
}
