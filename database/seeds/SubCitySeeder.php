<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['title' => "Dhaka", 'zip_code' => '1206','city_id' => 7291],
            ['title' => "Dhamrai", 'zip_code' => '1350','city_id' => 7291],
            ['title' => "Dhanmondi", 'zip_code' => '1209','city_id' => 7291],
            ['title' => "Gulshan", 'zip_code' => '1213','city_id' => 7291],
            ['title' => "Jatrabari", 'zip_code' => '1236','city_id' => 7291],
            ['title' => "Dhaka", 'zip_code' => '1206','city_id' => 7291],
            ['title' => "Joypara", 'zip_code'=> '1331','city_id' => 7291],
            ['title' => "Keraniganj", 'zip_code'=> '1312','city_id' => 7291],
            ['title' => "Khilgaon", 'zip_code'=> '1219','city_id' => 7291],
            ['title' => "Khilkhet", 'zip_code'=> '1229','city_id' => 7291],
            ['title' => "Lalbag", 'zip_code'=> '1211','city_id' => 7291],
            ['title' => "Mirpur", 'zip_code'=> '1216','city_id' => 7291],
            ['title' => "Mohammadpur", 'zip_code'=> '1207','city_id' => 7291],
            ['title' => "Motijheel", 'zip_code'=> '1222','city_id' => 7291],
            ['title' => "Nawabganj", 'zip_code'=> '1323','city_id' => 7291],
            ['title' => "New Market", 'zip_code'=> '1205','city_id' => 7291],
            ['title' => "Palton", 'zip_code'=> '1000','city_id' => 7291],
            ['title' => "Ramna", 'zip_code'=> '1217','city_id' => 7291],
            ['title' => "Sabujbag", 'zip_code'=> '1214','city_id' => 7291],
            ['title' => "Savar", 'zip_code'=> '1348','city_id' => 7291],
            ['title' => "Sutrapur", 'zip_code'=> '1100','city_id' => 7291],
            ['title' => "Tejgaon", 'zip_code'=> '1215','city_id' => 7291],
        ];

        $data = [];
        foreach ($cities as $city) {
            $city['created_at'] = Carbon::now();
            $city['updated_at'] = Carbon::now();
            $data[] = $city;
        }
        foreach (array_chunk($data, 1000) as $chunked_data) {
            DB::table('sub_cities')->insert($chunked_data);
        }
    }
}
