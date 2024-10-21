<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
        Schema::create('users', function (Blueprint $table) {
           $table->id(); // ユーザーID
            $table->string('name'); // 名前
            $table->string('email')->unique(); // メールアドレス (ユニーク)
            $table->string('password'); // パスワード
            $table->timestamps(); // 作成・更新日時
        });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
