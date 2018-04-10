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
        $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => "Developer",
            'userName' => 'dev',
            'email' => 'developer@developer.dev',
            'password' => bcrypt('password'),
            'defaultPassword' => bcrypt('password'),
        ]);
        DB::table('roles')->insert([
            'name' => "Developer",
            'description' => 'Developer',
        ]);
        DB::table('permissions')->insert([
            'name' => "Everything",
            'description' => 'Control over everything',
            'type' => 'omni',
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('role_permission')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);
        $notifications = array([
            'title' => "1",
            'description' => "one",
            "source" => "dev",
        ],
            [
                'title' => "2",
                'description' => "two",
                "source" => "dev",
            ],
            [
                'title' => "3",
                'description' => "three",
                "source" => "dev",
            ],
            [
                'title' => "4",
                'description' => "four",
                "source" => "dev",
            ],
            [
                'title' => "5",
                'description' => "five",
                "source" => "dev",
            ]);
        DB::table('notifications')->insert($notifications);
        DB::table('notification_user')->insert([
            'notification_id' => 1,
            'user_id' => 1,
            "read" => false,
        ],
            [
                'notification_id' => 2,
                'user_id' => 1,
                "read" => false,
            ],
            [
                'notification_id' => 3,
                'user_id' => 1,
                "read" => false,
            ],
            [
                'notification_id' => 4,
                'user_id' => 1,
                "read" => false,
            ],
            [
                'notification_id' => 5,
                'user_id' => 1,
                "read" => false,
            ]);

    }
}
