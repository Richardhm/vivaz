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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('administradora_id');
            $table->unsignedBigInteger('acomodacao_id')->nullable();
            $table->unsignedBigInteger('tabela_origens_id');
            $table->unsignedBigInteger('plano_id');
            $table->unsignedBigInteger('financeiro_id');
            $table->boolean('coparticipacao');
            $table->boolean('odonto');
            $table->string('codigo_externo');
            $table->date('data_vigencia')->nullable();
            $table->date('data_boleto')->nullable();
            $table->date('data_baixa')->nullable();
            $table->decimal('valor_adesao', 10, 2)->nullable();
            $table->decimal('valor_plano', 10, 2)->nullable();
            $table->decimal('desconto_corretora', 10, 2)->default(0.00);
            $table->decimal('desconto_corretor', 10, 2)->default(0.00);
            $table->boolean('estorno')->default(false);
            $table->date('data_baixa_estorno')->nullable();
            $table->timestamps();

            // Definir chaves estrangeiras
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('administradora_id')->references('id')->on('administradoras')->onDelete('cascade');
            $table->foreign('acomodacao_id')->references('id')->on('acomodacoes')->onDelete('set null');
            $table->foreign('tabela_origens_id')->references('id')->on('tabela_origens')->onDelete('cascade');
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
