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
        Schema::create('comissoes_corretores_configuracoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plano_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('administradora_id');
            $table->unsignedBigInteger('tabela_origens_id');
            $table->decimal('valor', 10, 2);
            $table->integer('parcela');
            $table->timestamps();

            // Definindo as chaves estrangeiras (se necessário)
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('administradora_id')->references('id')->on('administradoras')->onDelete('cascade');
            $table->foreign('tabela_origens_id')->references('id')->on('tabela_origens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissoes_corretores_configuracoes');
    }
};
