<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class permision extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'permCode'=>'1',
            'Description'=>'Admin',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'1',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'2',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'3',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'5',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'6',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'7',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'4',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'8',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'9',
        ]);
    }
}
