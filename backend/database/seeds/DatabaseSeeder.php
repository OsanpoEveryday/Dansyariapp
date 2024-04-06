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
        $this->call(UserSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ItemUsageHistoriesTableSeeder::class);
    }
}
