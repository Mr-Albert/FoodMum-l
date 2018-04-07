<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        DB::table('users')->insert([
            'name' => "Developer",
            'userName' => 'dev',
            'email' => 'developer@developer.dev',
            'password' => bcrypt('password'),
            'defaultPassword' => bcrypt('password')
        ]);
        DB::table('roles')->insert([
            'name' => "Developer",
            'description' => 'Developer'
        ]);
        DB::table('permissions')->insert([
            'name' => "Everything",
            'description' => 'Control over everything',
            'type'=>'omni'
        ]);
        // DB::table('role_user')->insert([
        //     'name' => "Everything",
        //     'description' => 'Control over everything',
        //     'type'=>'omni'
        // ]);
        // DB::table('role_permission')->insert([
        //     'name' => "Everything",
        //     'description' => 'Control over everything',
        //     'type'=>'omni'
        // ]);
    
    }
}
