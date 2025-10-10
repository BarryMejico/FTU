<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class menu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            'id'=>'1',
            'menuParent'=>'root',
            'Description'=>'System Admin',
            'icon'=>'basket',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'2',
            'menuParent'=>'root',
            'Description'=>'Data Builder',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'3',
            'menuParent'=>'2',
            'Description'=>'Teachers',
            'icon'=>'clipboard',
            'slug'=>'/teacher', 
        ]);

        DB::table('menu')->insert([
            'id'=>'11',
            'menuParent'=>'2',
            'Description'=>'Students',
            'icon'=>'clipboard',
            'slug'=>'/student', 
        ]);

        DB::table('menu')->insert([
            'id'=>'12',
            'menuParent'=>'x',
            'Description'=>'Edit permission',
            'icon'=>'clipboard',
            'slug'=>'/student', 
        ]);

        
        DB::table('menu')->insert([
            'id'=>'4',
            'menuParent'=>'root',
            'Description'=>'Teacher',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'8',
            'menuParent'=>'4',
            'Description'=>'Subjects',
            'icon'=>'clipboard',
            'slug'=>'/teacher-subjects', 
        ]);

        DB::table('menu')->insert([
            'id'=>'9',
            'menuParent'=>'4',
            'Description'=>'Modules',
            'icon'=>'clipboard',
            'slug'=>'/ReceivedPayments', 
        ]);

        DB::table('menu')->insert([
            'id'=>'10',
            'menuParent'=>'4',
            'Description'=>'Dashboard',
            'icon'=>'clipboard',
            'slug'=>'/teacherdashboard', 
        ]);

        DB::table('menu')->insert([
            'id'=>'5',
            'menuParent'=>'1',
            'Description'=>'Menu',
            'icon'=>'clipboard',
            'slug'=>'/menu', 
        ]);

        DB::table('menu')->insert([
            'id'=>'6',
            'menuParent'=>'1',
            'Description'=>'Users',
            'icon'=>'clipboard',
            'slug'=>'/user',
        ]);

        DB::table('menu')->insert([
            'id'=>'7',
            'menuParent'=>'1',
            'Description'=>'Permissions',
            'icon'=>'clipboard',
            'slug'=>'/permission', 
        ]);

         DB::table('menu')->insert([
            'id'=>'13',
            'menuParent'=>'1',
            'Description'=>'Permissions-Modify',
            'icon'=>'clipboard',
            'slug'=>'/permission-modify', 
        ]);

        DB::table('menu')->insert([
            'id'=>'14',
            'menuParent'=>'root',
            'Description'=>'Administrator',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'15',
            'menuParent'=>'14',
            'Description'=>'Courses',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);
                DB::table('menu')->insert([
            'id'=>'16',
            'menuParent'=>'14',
            'Description'=>'Subjects',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

                DB::table('menu')->insert([
            'id'=>'17',
            'menuParent'=>'14',
            'Description'=>'Grades',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'18',
            'menuParent'=>'root',
            'Description'=>'Student',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'19',
            'menuParent'=>'18',
            'Description'=>'Courses',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'20',
            'menuParent'=>'18',
            'Description'=>'Accomplishments',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

         DB::table('menu')->insert([
            'id'=>'21',
            'menuParent'=>'root',
            'Description'=>'Course Admin',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'22',
            'menuParent'=>'21',
            'Description'=>'Batches',
            'icon'=>'clipboard',
            'slug'=>'/coursedirector', 
        ]);
    }
}
