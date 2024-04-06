<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'testuser1',
            'email' => 'testuser1@hogehoge.com',
            'password' => Hash::make('testuser1'),
        ]);
        DB::table('users')->insert([
            'name' => 'testuser2',
            'email' => 'testuser2@hogehoge.com',
            'password' => Hash::make('testuser2'),
        ]);
    }
}
