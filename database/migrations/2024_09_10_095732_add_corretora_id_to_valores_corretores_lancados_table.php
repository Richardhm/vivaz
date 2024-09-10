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
        Schema::table('valores_corretores_lancados', function (Blueprint $table) {
            $table->unsignedBigInteger('corretora_id')->nullable()->after('id'); // Pode usar after para definir a posição da coluna

            // Define a foreign key para a tabela corretoras
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade'); // onDelete set null se o corretora for deletado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valores_corretores_lancados', function (Blueprint $table) {
            // Remove a foreign key
            $table->dropForeign(['corretora_id']);

            // Remove a coluna
            $table->dropColumn('corretora_id');
        });
    }
};
