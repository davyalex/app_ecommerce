<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roles')->delete();
        
        DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'administrateur',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'vendeur',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'client',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'fournisseur',
                'guard_name' => 'web',
                'created_at' => '2023-11-14 22:22:55',
                'updated_at' => '2023-11-14 22:22:55',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'webmaster',
                'guard_name' => 'web',
                'created_at' => '2023-11-28 21:36:35',
                'updated_at' => '2023-11-28 21:36:35',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'livreur',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}