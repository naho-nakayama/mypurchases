<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
            'id'  => 1 ,
            'name' => '衣類' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 2 ,
            'name' => '食べ物・飲み物' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 3 ,
            'name' => '本' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 4 ,
            'name' => '日用品' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 5 ,
            'name' => '雑貨' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 6 ,
            'name' => 'アクセサリー' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 7 ,
            'name' => '化粧品・スキンケア' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 8 ,
            'name' => 'ゲーム' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 9 ,
            'name' => '機器' ,
        ]);
        
        DB::table("categories")->insert([
            'id'  => 10 ,
            'name' => 'その他' ,
        ]);
    }
}
