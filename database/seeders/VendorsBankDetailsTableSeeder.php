<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetails;


class VendorsBankDetailsTableSeeder extends Seeder
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
            'account_holder_name' => 'Rizki Dinelvi',
            'bank_name'=> 'BSI',
            'account_number' => '09454513',
            'bank_ifsc_code' => '432452',
            ]
        ];
        VendorsBankDetails::insert($vendorRecords);
    }
}
