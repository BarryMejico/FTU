<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class menu extends Seeder
{
    /**
     * Run the database seeds.
     * /storage/storage/icons/System/dashboard-line.svg
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            'id'=>'1',
            'menuParent'=>'root',
            'Description'=>'System Admin',
            'icon'=>'/storage/icons/UserFaces/user-settings-fill.svg',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'2',
            'menuParent'=>'root',
            'Description'=>'Data Builder',
            'icon'=>'/storage/icons/Device/database-line.svg',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'3',
            'menuParent'=>'2',
            'Description'=>'Instructors',
            'icon'=>'/storage/icons/Business/presentation-fill.svg',
            'slug'=>'/instructors', 
        ]);

        DB::table('menu')->insert([
            'id'=>'11',
            'menuParent'=>'2',
            'Description'=>'Students',
            'icon'=>'/storage/icons/Business/id-card-line.svg',
            'slug'=>'/student', 
        ]);

        DB::table('menu')->insert([
            'id'=>'12',
            'menuParent'=>'x',
            'Description'=>'Edit permission',
            'icon'=>'/storage/icons/userFaces/account-box-line.svg',
            'slug'=>'/student', 
        ]);

        
        // Rename Teacher section to Instructor and add submenus
        DB::table('menu')->insert([
            'id'=>'4',
            'menuParent'=>'root',
            'Description'=>'Instructor',
            'icon'=>'/storage/icons/Business/presentation-line.svg',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'8',
            'menuParent'=>'4',
            'Description'=>'Instructors Profile',
            'icon'=>'/storage/icons/Userfaces/user-fill.svg',
            'slug'=>'/instructor-profile', 
        ]);

        DB::table('menu')->insert([
            'id'=>'9',
            'menuParent'=>'4',
            'Description'=>'List of Instructors',
            'icon'=>'clipboard',
            'slug'=>'/instructors', 
        ]);

        DB::table('menu')->insert([
            'id'=>'10',
            'menuParent'=>'4',
            'Description'=>'Dashboard',
            'icon'=>'/storage/icons/System/dashboard-line.svg',
            'slug'=>'/teacherdashboard', 
        ]);

        DB::table('menu')->insert([
            'id'=>'5',
            'menuParent'=>'1',
            'Description'=>'Menu',
            'icon'=>'/storage/icons/System/menu-fill.svg',
            'slug'=>'/menu', 
        ]);

        DB::table('menu')->insert([
            'id'=>'6',
            'menuParent'=>'1',
            'Description'=>'Users',
            'icon'=>'/storage/icons/UserFaces/group-line.svg',
            'slug'=>'/user',
        ]);

        DB::table('menu')->insert([
            'id'=>'7',
            'menuParent'=>'1',
            'Description'=>'Permissions',
            'icon'=>'/storage/icons/Others/key-line.svg',
            'slug'=>'/permission', 
        ]);

         DB::table('menu')->insert([
            'id'=>'13',
            'menuParent'=>'1',
            'Description'=>'Permissions-Modify',
            'icon'=>'/storage/icons/Others/key-fill.svg',
            'slug'=>'/permission-modify',
        ]);

        DB::table('menu')->insert([
            'id'=>'14',
            'menuParent'=>'root',
            'Description'=>'Administrator',
            'icon'=>'/storage/icons/UserFaces/admin-line.svg',
            'slug'=>'0', 
        ]);

        DB::table('menu')->insert([
            'id'=>'15',
            'menuParent'=>'14',
            'Description'=>'Courses',
            'icon'=>'/storage/icons/Document/book-open-line.svg',
            'slug'=>'/courses', 
        ]);
                DB::table('menu')->insert([
            'id'=>'16',
            'menuParent'=>'14',
            'Description'=>'Subjects',
            'icon'=>'/storage/icons/Others/book-shelf-line.svg',
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
            'Description'=>'My Courses',
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

        DB::table('menu')->insert([
            'id'=>'23',
            'menuParent'=>'18',
            'Description'=>'Schedule',
            'icon'=>'clipboard',
            'slug'=>'/scheude', 
        ]);

        DB::table('menu')->insert([
            'id'=>'24',
            'menuParent'=>'root',
            'Description'=>'Available Courses',
            'icon'=>'clipboard',
            'slug'=>'/Availablecourses', 
        ]);
    }
}
