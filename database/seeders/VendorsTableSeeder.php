<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id'=> 1,
                'name' => 'Rizki',
                'address' => 'CP-112',
                'city' => 'Pekanbaru',
                'state' => 'Melayu',
                'country' => 'Indonesia',
                'pincode' => '110001',
                'mobile' => '08212233232',
                'email' => 'rizki@gmail.com',
                'status' => 0
            ]
        ];

        Vendor::insert($vendorRecords);
    }
}
