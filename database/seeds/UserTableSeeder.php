<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = [
            ['name' => 'Nk Service', 'email' => 'info@nk.com', 'password' => bcrypt('secret'), 'publish' => 'approved', 'main' => 1, 'role' => 'admin', 'flag' => 1, 'new' => 0],
            ['name' => 'Nk Service', 'email' => 'info@nkservice.com', 'password' => bcrypt('nkservice@123'), 'publish' => 'approved', 'main' => 1, 'role' => 'admin', 'flag' => 1, 'new' => 0],
        ];
        \App\User::insert($data);

    }
}
