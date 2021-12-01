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
        Schema::create('bought', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bought_name');//買ったものを保存するカラム
            $table->string('bought_price'); //買った物の値段を保存するカラム
            $table->string('bought_sitename');// 買った物のサイト名を保存するカラム
            $table->integer('date');//買った日付を入れる。月表示と１日ごとの表示のカラム
            $table->integer('category_id');//カテゴリーを買ったモノに登録をするカラム
            $table->integer('users_id');//ユーザー情報を紐付けるカラム
            $table->string('image_path')->nullable();// 画像のパスを保存するカラム
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
        Schema::dropIfExists('bought');
    }
}
