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
                'name' => 'Admin 1',
                'user_Type' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('admin1'),
                'age' => 30,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Admin 2',
                'user_Type' => 'Admin',
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('admin2'),
                'age' => 35,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Admin 3',
                'user_Type' => 'Admin',
                'email' => 'admin3@gmail.com',
                'password' => bcrypt('admin3'),
                'age' => 40,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'name' => 'Dr. John',
                'user_Type' => 'Doctor',
                'email' => 'john@gmail.com',
                'password' => bcrypt('john'),
                'age' => 40,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Dr. Samantha',
                'user_Type' => 'Doctor',
                'email' => 'samantha@gmail.com',
                'password' => bcrypt('samantha'),
                'age' => 35,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 6,
                'name' => 'Dr. Michael',
                'user_Type' => 'Doctor',
                'email' => 'michael@gmail.com',
                'password' => bcrypt('michael'),
                'age' => 45,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Dr. Emily',
                'user_Type' => 'Doctor',
                'email' => 'emily@gmail.com',
                'password' => bcrypt('emily'),
                'age' => 38,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Dr. William',
                'user_Type' => 'Doctor',
                'email' => 'william@gmail.com',
                'password' => bcrypt('william'),
                'age' => 42,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Dr. Olivia',
                'user_Type' => 'Doctor',
                'email' => 'olivia@gmail.com',
                'password' => bcrypt('olivia'),
                'age' => 37,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Dr. Benjamin',
                'user_Type' => 'Doctor',
                'email' => 'benjamin@gmail.com',
                'password' => bcrypt('benjamin'),
                'age' => 40,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 11,
                'name' => 'Alice Johnson',
                'user_Type' => 'Patient',
                'email' => 'alice@gmail.com',
                'password' => bcrypt('alice123'),
                'age' => 25,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Bob Smith',
                'user_Type' => 'Patient',
                'email' => 'bob@gmail.com',
                'password' => bcrypt('bob123'),
                'age' => 30,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'Emma Watson',
                'user_Type' => 'Patient',
                'email' => 'emma@gmail.com',
                'password' => bcrypt('emma123'),
                'age' => 28,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'David Wilson',
                'user_Type' => 'Patient',
                'email' => 'david@gmail.com',
                'password' => bcrypt('david123'),
                'age' => 32,
                'gender' => 'Male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'name' => 'Lala Martinez',
                'user_Type' => 'Patient',
                'email' => 'lala@gmail.com',
                'password' => bcrypt('lala'),
                'age' => 27,
                'gender' => 'Female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
