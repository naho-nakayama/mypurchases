<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('want_items', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('name'); // 買いたいものの名前を保存するカラム
             $table->string('price'); // 買いたい物の値段を保存するカラム
             $table->string('sitename'); // 買いたいものがあるサイト名を保存するカラム
             $table->integer('category_id'); // カテゴリーを買いたいモノに登録をするカラム
             $table->integer('user_id'); // ユーザー情報を紐付けるカラム
            $table->timestamps();
        });
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('want_items');
        
    }
}
