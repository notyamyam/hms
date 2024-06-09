<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [   
                'id' => 1,
                'name' => 'Admin1',
                'user_Type' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('admin1'),
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [   
                'id' => 2,
                'name' => 'Doctor1',
                'user_Type' => 'Doctor',
                'email' => 'doctor1@gmail.com',
                'password' => bcrypt('doctor1'),
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'name' => 'Patient1',
                'user_Type' => 'Patient',
                'email' => 'patient1@gmail.com',
                'password' => bcrypt('patient1'),
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
