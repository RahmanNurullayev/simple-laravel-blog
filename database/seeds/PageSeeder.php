<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Haqqımızda','Karyera','Maraqlı','Qalereya'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>Str::slug($page),
                'image'=>'https://thumbor.forbes.com/thumbor/fit-in/1200x0/filters%3Aformat%28jpg%29/https%3A%2F%2Fblogs-images.forbes.com%2Falejandrocremades%2Ffiles%2F2018%2F07%2Fdesk-3139127_1920-1200x773.jpg',
                'content'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium sed quo porro quasi blanditiis in! Sapiente suscipit culpa ut, similique neque laudantium maiores dicta consequatur fugiat assumenda corporis, quos a!',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
