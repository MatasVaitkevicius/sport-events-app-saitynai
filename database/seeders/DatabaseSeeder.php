<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ //1
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([ //1
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        DB::table('types')->insert([ //1
            'name' => "Type 1",
        ]);

        DB::table('types')->insert([ //1
            'name' => "Type 2",
        ]);

        DB::table('types')->insert([ //1
            'name' => "Type 3",
        ]);

        DB::table('events')->insert([ //1
            'name' => "Type 1 Event 1",
            'description' => "Test description",
            'type_id' => 1,
        ]);

        DB::table('events')->insert([ //1
            'name' => "Type 1 Event 2",
            'description' => "Test description",
            'type_id' => 1,
        ]);


        DB::table('events')->insert([ //1
            'name' => "Type 2 Event 3",
            'description' => "Test description",
            'type_id' => 2,
        ]);

        DB::table('events')->insert([ //1
            'name' => "Type 3 Event 4",
            'description' => "Test description",
            'type_id' => 3,
        ]);

        DB::table('comments')->insert([ //1
            'content' => "Event 1 Comment 1",
            'event_id' => 1,
        ]);

        DB::table('comments')->insert([ //1
            'content' => "Event 1 Comment 2",
            'event_id' => 1,
        ]);

        DB::table('comments')->insert([ //1
            'content' => "Event 2 Comment 3",
            'event_id' => 2,
        ]);

        DB::table('comments')->insert([ //1
            'content' => "Event 3 Comment 4",
            'event_id' => 3,
        ]);
    }
}
