<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class); 
        $this->call(RoleUserTableSeeder::class);                
        $this->call(CountrySeeder::class);                
        $this->call(StateSeeder::class);                
        $this->call(CitySeeder::class);                
        $this->call(SubCitySeeder::class);
        $this->call(LicenceSeeder::class);                
    }
}
