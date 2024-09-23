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
        Schema::table('ranking_diario', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable(); // Adiciona a coluna user_id após a coluna id
            // Se quiser criar uma foreign key, descomente as linhas abaixo
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ranking_diario', function (Blueprint $table) {
            $table->dropColumn('user_id');
            // Se houver foreign key, também remova aqui
            $table->dropForeign(['user_id']);
        });
    }
};
