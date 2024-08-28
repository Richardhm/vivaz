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
        Schema::create('comissoes_corretores_default', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('corretora_id'); // Cria a coluna 'corretora_id'
            $table->unsignedBigInteger('plano_id'); // Cria a coluna 'plano_id'
            $table->unsignedBigInteger('administradora_id'); // Cria a coluna 'administradora_id'
            $table->unsignedBigInteger('tabela_origens_id')->nullable(); // Cria a coluna 'tabela_origens_id'
            $table->decimal('valor', 8, 2); // Cria a coluna 'valor' com precisão de 8 dígitos, sendo 2 decimais
            $table->integer('parcela'); // Cria a coluna 'parcela'
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' automaticamente

            // Definir chaves estrangeiras e relacionamentos, se necessário
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade');
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');
            $table->foreign('administradora_id')->references('id')->on('administradoras')->onDelete('cascade');
            $table->foreign('tabela_origens_id')->references('id')->on('tabela_origens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissoes_corretores_default');
    }
};
