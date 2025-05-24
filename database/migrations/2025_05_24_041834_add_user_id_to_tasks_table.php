<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }

};
Schema::table('tasks', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id');

    // ユーザーとの外部キー制約を設定する場合
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

