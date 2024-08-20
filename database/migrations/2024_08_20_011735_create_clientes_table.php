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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nome')->nullable();
            $table->string('cidade')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefone', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cep');
            $table->string('rua')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('uf')->nullable();
            $table->string('cnpj')->nullable();
            $table->boolean('pessoa_fisica')->nullable();
            $table->boolean('pessoa_juridica')->nullable();
            $table->string('codigo_externo', 50)->nullable();
            $table->boolean('dependente')->nullable();
            $table->string('nm_plano', 250)->nullable();
            $table->string('numero_registro_plano', 250)->nullable();
            $table->string('rede_plano', 250)->nullable();
            $table->string('tipo_acomodacao_plano', 250)->nullable();
            $table->string('segmentacao_plano', 250)->nullable();
            $table->string('cateirinha', 100)->nullable();
            $table->integer('quantidade_vidas')->nullable();
            $table->boolean('dados')->default(false);
            $table->date('baixa')->nullable();
            $table->timestamps();

            // Definir a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
