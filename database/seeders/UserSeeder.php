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
                'name' => 'Idah Saridah',
                'email' => 'idahsaridah@gmail.com',
                'phone_number' => '085860459990',
                'alamat' => 'Mangunkerta',
                'tgl_lahir' => '2000-12-12',
                'kelamin' => 'Perempuan',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'role_id' => 1,
            ],
        ]);
    }
}
