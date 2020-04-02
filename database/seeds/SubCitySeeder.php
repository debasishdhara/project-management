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
