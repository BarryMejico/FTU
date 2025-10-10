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
            'Description'=>'System Admin',
        ]);

        DB::table('permissions')->insert([
            'permCode'=>'2',
            'Description'=>'Teacher',
        ]);

        DB::table('permissions')->insert([
            'permCode'=>'3',
            'Description'=>'Student',
        ]);

        DB::table('permissions')->insert([
            'permCode'=>'4',
            'Description'=>'Administrator',
        ]);

        DB::table('permissions')->insert([
            'permCode'=>'5',
            'Description'=>'Course Admin',
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

         DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'11',
        ]);

         DB::table('permission_details')->insert([
            'permiCode'=>'1',
            'id'=>'13',
        ]);
// ----------- for teacher
        DB::table('permission_details')->insert([
            'permiCode'=>'2',
            'id'=>'4',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'2',
            'id'=>'8',
        ]);

                DB::table('permission_details')->insert([
            'permiCode'=>'2',
            'id'=>'9',
        ]);

                DB::table('permission_details')->insert([
            'permiCode'=>'2',
            'id'=>'10',
        ]);

// ----------- for student
        DB::table('permission_details')->insert([
            'permiCode'=>'3',
            'id'=>'18',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'3',
            'id'=>'19',
        ]);

         DB::table('permission_details')->insert([
            'permiCode'=>'3',
            'id'=>'20',
        ]);
// -------------for Administrator
        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'3',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'12',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'14',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'15',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'16',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'4',
            'id'=>'17',
        ]);

        // -------------for Course Admin
        DB::table('permission_details')->insert([
            'permiCode'=>'5',
            'id'=>'3',
        ]);

        DB::table('permission_details')->insert([
            'permiCode'=>'5',
            'id'=>'12',
        ]);
        
        DB::table('permission_details')->insert([
            'permiCode'=>'5',
            'id'=>'14',
        ]);

        
    }
}
