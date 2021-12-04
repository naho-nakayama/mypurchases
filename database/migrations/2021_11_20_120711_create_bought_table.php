<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoughtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');//買ったものを保存するカラム
            $table->string('price'); //買った物の値段を保存するカラム
            $table->string('sitename');// 買った物のサイト名を保存するカラム
            $table->integer('date');//買った日付を入れる。月表示と１日ごとの表示のカラム
            $table->integer('category_id');//カテゴリーを買ったモノに登録をするカラム
            $table->integer('user_id');//ユーザー情報を紐付けるカラム
            $table->string('image_path')->nullable();// 画像のパスを保存するカラム
            $table->timestamps();
        });
        Schema::rename('bought', 'bought_items');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bought');
        Schema::rename('bought_items', 'bought');
    }
}
