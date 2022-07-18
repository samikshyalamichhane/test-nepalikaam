<?php

use Illuminate\Database\Seeder;

class DashboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dashboards')->delete();
        $data = new App\Models\Dashboard([
            'facebook' => '',
            'twitter' => '',
            'email' => '',
            'address' => '',
            'phone' => '',
            'password' => 'secret',
        ]);
        $data->save();
    }
}
