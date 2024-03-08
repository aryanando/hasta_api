<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // User::create([
        //     'name' => 'Eko Ari',
        //     'email' => 'eko@demo.com',
        //     'password' => Hash::make('12345678')
        // ]);

        DB::table('users')->insert([

            [
                'name' => 'Administrator',
                'email' => 'admin@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Eko Ari',
                'email' => 'eko@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Nando',
                'email' => 'nando@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
