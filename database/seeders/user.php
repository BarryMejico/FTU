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
                        'Profile_Picture'=>'/storage/assets/Default.png',

        ]);

        DB::table('users')->insert([
            'name' => 'Jayson Calixto',
            'email' => 'JaysonCalixto@gmail.com',
            'password' => Hash::make('barrymejico'),
            'permiCode'=>'3',
            'email_verified_at'=>'2021-10-13 20:40:32',
            'code'=>'2',
            // 'Reference_ID'=>'5',
            'Profile_Picture'=>'/storage/assets/Default.png',
        ]);

        DB::table('users')->insert([
            'name' => 'Sarah Johnson',
            'email' => 'sarahjohnson@gmail.com',
            'password' => Hash::make('barrymejico'),
            'permiCode'=>'2',
            'email_verified_at'=>'2021-10-13 20:40:32',
            'code'=>'3',
            // 'Reference_ID'=>'5',
            'Profile_Picture'=>'/storage/assets/Default.png',
        ]);
    }
}
