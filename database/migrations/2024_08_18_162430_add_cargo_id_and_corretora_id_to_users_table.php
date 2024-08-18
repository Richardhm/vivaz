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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona as colunas cargo_id e corretora_id
            $table->unsignedBigInteger('cargo_id')->nullable()->after('id');
            $table->unsignedBigInteger('corretora_id')->nullable()->after('cargo_id');

            // Define as chaves estrangeiras
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove as chaves estrangeiras e as colunas
            $table->dropForeign(['cargo_id']);
            $table->dropForeign(['corretora_id']);
            $table->dropColumn('cargo_id');
            $table->dropColumn('corretora_id');
        });
    }
};
