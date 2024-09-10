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
        Schema::table('folha_mes', function (Blueprint $table) {
            // Adiciona a coluna corretora_id
            $table->unsignedBigInteger('corretora_id')->nullable()->after('id');

            // Define a foreign key para a tabela corretoras
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('folha_mes', function (Blueprint $table) {
            // Remove a foreign key
            $table->dropForeign(['corretora_id']);

            // Remove a coluna
            $table->dropColumn('corretora_id');
        });
    }
};
