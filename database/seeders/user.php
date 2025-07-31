<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Barry Mejico',
            'email' => 'barrymejico@gmail.com',
            'password' => Hash::make('barrymejico'),
            'permiCode'=>'1',
            'email_verified_at'=>'2021-10-13 20:40:32',
            'code'=>'1',
            // 'Reference_ID'=>'5',
            // 'Profile_Picture'=>'ProfilePictures/2222-06-01050710-2222-02-09032774-2222-01-14015845-FB_IMG_1586408766904.jpg',
        ]);
    }
}
