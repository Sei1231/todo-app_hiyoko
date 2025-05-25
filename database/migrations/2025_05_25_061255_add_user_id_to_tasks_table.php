<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * tasksテーブルに user_id カラムを追加し、usersテーブルと紐づける
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // user_id カラムの追加（usersテーブルのidと紐付ける）
            $table->unsignedBigInteger('user_id')->after('id');

            // 外部キー制約を追加（ユーザーが削除されたら、その人のタスクも削除される）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * 追加した user_id カラムと外部キーを削除
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 外部キー制約を先に削除
            $table->dropForeign(['user_id']);

            // カラムを削除
            $table->dropColumn('user_id');
        });
    }
};
