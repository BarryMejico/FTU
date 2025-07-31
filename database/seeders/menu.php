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
        DB::table('menus')->insert([
            'id'=>'1',
            'menuParent'=>'root',
            'Description'=>'System Admin',
            'icon'=>'basket',
            'slug'=>'0', 
        ]);

        DB::table('menus')->insert([
            'id'=>'2',
            'menuParent'=>'root',
            'Description'=>'menu 1',
            'icon'=>'clipboard',
            'slug'=>'/nextTime', 
        ]);

        DB::table('menus')->insert([
            'id'=>'3',
            'menuParent'=>'root',
            'Description'=>'Menu 2',
            'icon'=>'clipboard',
            'slug'=>'/nextTime', 
        ]);

        
        DB::table('menus')->insert([
            'id'=>'4',
            'menuParent'=>'root',
            'Description'=>'Menu 3',
            'icon'=>'clipboard',
            'slug'=>'0', 
        ]);

        DB::table('menus')->insert([
            'id'=>'8',
            'menuParent'=>'4',
            'Description'=>'submenu',
            'icon'=>'clipboard',
            'slug'=>'/encashment', 
        ]);

        DB::table('menus')->insert([
            'id'=>'9',
            'menuParent'=>'4',
            'Description'=>'Submenu 4 1',
            'icon'=>'clipboard',
            'slug'=>'/ReceivedPayments', 
        ]);

        DB::table('menus')->insert([
            'id'=>'10',
            'menuParent'=>'4',
            'Description'=>'Submenu 4 2',
            'icon'=>'clipboard',
            'slug'=>'/FinancialReport', 
        ]);

        DB::table('menus')->insert([
            'id'=>'5',
            'menuParent'=>'1',
            'Description'=>'Menu',
            'icon'=>'clipboard',
            'slug'=>'/menu', 
        ]);

        DB::table('menus')->insert([
            'id'=>'6',
            'menuParent'=>'1',
            'Description'=>'Users',
            'icon'=>'clipboard',
            'slug'=>'/user',
        ]);

        DB::table('menus')->insert([
            'id'=>'7',
            'menuParent'=>'1',
            'Description'=>'Permissions',
            'icon'=>'clipboard',
            'slug'=>'/permission', 
        ]);
    }
}
