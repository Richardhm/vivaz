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
        Schema::create('ranking_diario', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do usuário ou corretora
            $table->unsignedBigInteger('corretora_id'); // Relacionamento com corretora
            $table->integer('vidas_individual')->default(0); // Vidas do plano individual
            $table->integer('vidas_coletivo')->default(0); // Vidas do plano coletivo
            $table->integer('vidas_empresarial')->default(0); // Vidas do plano empresarial
            $table->date('data'); // Data do ranking
            $table->timestamps(); // Campos de controle (created_at, updated_at)

            // Definir chave estrangeira com a tabela corretoras
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_diario');
    }
};
