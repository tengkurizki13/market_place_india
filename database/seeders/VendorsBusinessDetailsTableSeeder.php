<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetails;


class VendorsBusinessDetailsTableSeeder extends Seeder
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
            'vendor_id' => '1',
            'shop_name' => 'Rizki Electronics Store',
            'shop_address'=> '1234-SCF',
            'shop_city' => 'Pekanbaru',
            'shop_state' => 'Melayu',
            'shop_country' => 'Indonesia',
            'shop_pincode'=> '110001',
            'shop_mobile' => '0814234213',
            'shop_website' => 'www.eletronic.com',
            'shop_email' => 'rizki@gmail.com',
            'address_proof' => 'Passport',
            'address_proof_image' => 'test.jpg',
            'business_license_number' => '1232342142',
            'get_number' => '34235235',
            'pan_number' => '54345245'
            ]
        ];
        VendorsBusinessDetails::insert($vendorRecords);
    }
}
