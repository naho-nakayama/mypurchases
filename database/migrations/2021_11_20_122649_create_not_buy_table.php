<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_buy', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('notbuy_name'); // 買いたいものの名前を保存するカラム
             $table->string('notbuy_price'); // 買いたい物の値段を保存するカラム
             $table->string('notbuy_sitename'); // 買いたいものがあるサイト名を保存するカラム
             $table->integer('category_id'); // カテゴリーを買いたいモノに登録をするカラム
             $table->integer('users_id'); // ユーザー情報を紐付けるカラム
             $table->integer('date');//買いたいものリストを追加したそれぞれの日付を入れる。これも月表示と１日ごとの表示
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
        Schema::dropIfExists('not_buy');
    }
}
