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
        Schema::table('concessionarias', function (Blueprint $table) {
            // Adiciona a coluna imagem depois da coluna nome
            $table->string('imagem')->nullable()->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concessionarias', function (Blueprint $table) {
            // Remove a coluna imagem
            $table->dropColumn('imagem');
        });
    }
};
