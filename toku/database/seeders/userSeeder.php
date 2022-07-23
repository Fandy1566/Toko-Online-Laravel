<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id_user' => 'Admin',
            'name' => 'Admin',
            'telp' => '081200000000',
            'Alamat' => 'Admin',
            'Gender' => '?',
            'Email' => 'admin@admin.com',
            'password' => 'admin',
            'level' => '1',
        ]);
    }
}
