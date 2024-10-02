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
        Schema::create('pdf_excecao', function (Blueprint $table) {
            $table->id();
            // Foreign key to planos table
            $table->foreignId('plano_id')->constrained('planos')->onDelete('cascade');
            // Foreign key to tabela_origens table
            $table->foreignId('tabela_origens_id')->constrained('tabela_origens')->onDelete('cascade');
            // Other fields
            $table->string('linha01', 255)->nullable();
            $table->string('linha02', 255)->nullable();
            $table->string('linha03', 255)->nullable();
            $table->string('consultas_eletivas_total', 255)->nullable();
            $table->string('pronto_atendimento', 255)->nullable();
            $table->string('faixa_1', 255)->nullable();
            $table->string('faixa_2', 255)->nullable();
            $table->string('faixa_3', 255)->nullable();
            $table->string('faixa_4', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_excecao');
    }
};
