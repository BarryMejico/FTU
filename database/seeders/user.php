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
                        'Profile_Picture'=>'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',

        ]);

        DB::table('users')->insert([
            'name' => 'Jayson Calixto',
            'email' => 'JaysonCalixto@gmail.com',
            'password' => Hash::make('barrymejico'),
            'permiCode'=>'1',
            'email_verified_at'=>'2021-10-13 20:40:32',
            'code'=>'2',
            // 'Reference_ID'=>'5',
            'Profile_Picture'=>'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
        ]);

        DB::table('users')->insert([
            'name' => 'Sarah Johnson',
            'email' => 'sarahjohnson@gmail.com',
            'password' => Hash::make('barrymejico'),
            'permiCode'=>'1',
            'email_verified_at'=>'2021-10-13 20:40:32',
            'code'=>'3',
            // 'Reference_ID'=>'5',
            'Profile_Picture'=>'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
        ]);
    }
}
