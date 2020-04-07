<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Licence;

class LicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licences')->insert([[
            'licence_name' => 'Demo',
            'licence_key' => $this->generateBarcodeNumber(),
            'licence_description' => '<ul><li>Demo User 2 Available</li><li>Validity For 7 Days</li></ul>',
            'licence_discount'=> 0.00,
            'licence_amount'=> 0.00,
            'licence_tax'=> 0.00,
            'licence_taxableamount'=> 0.00,
            'licence_net_amount'=> 0.00,
            'licence_validity'=> 7,
            'licence_user_limit'=> 2,
            'licence_status'=>true,
            'licence_pre_status'=>true
        ]]);
    }

    function generateBarcodeNumber() {
        $charfromme='D';
        $chars = array($charfromme,'D','E','B','A','S','I','S','H',0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K',0,1,2,3,4,5,6,7,8,9,'L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',0,1,2,3,4,5,6,7,8,9);
        $serial = '';
        $max = count($chars)-1;
        for($i=0;$i<40;$i++){
            $serial .= (!($i % 8) && $i ? '-' : '').$chars[rand(0, $max)];
        }
        $number = $serial;
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Licence::where('licence_key',$number)->exists();
    }
}
