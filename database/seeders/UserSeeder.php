<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '085860459990',
                'address' => 'Mangunkerta',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'role_id' => 1,
            ],
            [
                'name' => 'dokter',
                'email' => 'dokter@gmail.com',
                'phone_number' => '085870408890',
                'address' => 'Mangunkerta',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'role_id' => 2,
            ],
        ]);
    }
}
