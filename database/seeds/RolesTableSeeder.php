<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'role_name' => 'SUPERADMIN',
            'role_status' => true,
            'primary_status' => true
        ],[
            'role_name' => 'ADMIN',
            'role_status' => true,
            'primary_status' => true
        ],[
            'role_name' => 'USER',
            'role_status' => true,
            'primary_status' => true
        ]]);
    }
}
