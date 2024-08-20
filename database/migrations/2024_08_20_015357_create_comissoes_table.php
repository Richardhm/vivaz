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
        Schema::create('comissoes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->unsignedBigInteger('plano_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('administradora_id');
            $table->unsignedBigInteger('tabela_origens_id');
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->unsignedBigInteger('contrato_empresarial_id')->nullable();
            $table->tinyInteger('empresarial')->default(0);
            $table->timestamps();

            // Definir chaves estrangeiras
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('administradora_id')->references('id')->on('administradoras')->onDelete('cascade');
            $table->foreign('tabela_origens_id')->references('id')->on('tabela_origens')->onDelete('cascade');
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('set null');
            $table->foreign('contrato_empresarial_id')->references('id')->on('contrato_empresarial')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissoes');
    }
};
