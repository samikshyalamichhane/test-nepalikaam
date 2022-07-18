<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();
        $data = [
        	['title'=>'About Us','slug'=>str_slug('about us'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1']
        	];
        \App\Models\Page::insert($data);
    }
}
