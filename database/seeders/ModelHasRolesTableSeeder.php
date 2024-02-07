<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('model_has_roles')->delete();
        
        DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1965711134,
            ),
            1 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3149346027,
            ),
            2 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 8733553088,
            ),
            3 => 
            array (
                'role_id' => 1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 17897826631,
            ),
            4 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 6522417448,
            ),
            5 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 7493374124,
            ),
            6 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\Models\\User',
                'model_id' => 16476549411,
            ),
        ));
        
        
    }
}