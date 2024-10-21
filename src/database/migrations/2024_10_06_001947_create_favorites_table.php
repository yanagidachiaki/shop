<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('favorites', function (Blueprint $table) {
                $table->id();
                // 外部キーはusersテーブルのidと接続（必要に応じてuser_idに変更）
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                // shopsテーブルのidと接続
                $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
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
        Schema::dropIfExists('favorites');
    }
}
