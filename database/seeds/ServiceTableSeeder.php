<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->delete();
        $data = [
        	['title'=>'Air Ticketing','slug'=>str_slug('air ticketing'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
        	['title'=>'Edu Consulting','slug'=>str_slug('edu cosulting'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
        	['title'=>'Tax Return','slug'=>str_slug('tax return'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
        	['title'=>'Money Transfer','slug'=>str_slug('money transfer'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1']
        	];
        \App\Models\Service::insert($data);
    }
}
