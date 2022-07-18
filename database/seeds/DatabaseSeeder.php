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
        $this->call(UserTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        DB::unprepared(file_get_contents('database/seeds/countries.sql'));
        $this->command->info('Country table seeded!');
    }
}
