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
        Schema::create('valores_corretores_lancados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID do usuário, assumindo que seja uma referência para a tabela 'users'
            $table->date('data'); // Data
            $table->decimal('valor_comissao', 10, 2); // Valor da comissão
            $table->decimal('valor_salario', 10, 2); // Valor do salário
            $table->decimal('valor_premiacao', 10, 2); // Valor da premiação
            $table->decimal('valor_total', 10, 2)->nullable(); // Valor total, pode ser nulo
            $table->decimal('valor_desconto', 10, 2)->nullable(); // Valor do desconto, pode ser nulo
            $table->decimal('valor_estorno', 10, 2)->nullable(); // Valor do estorno, pode ser nulo
            $table->timestamps(); // Colunas created_at e updated_at

            // Definir chave estrangeira para user_id (assumindo que seja uma referência à tabela 'users')
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valores_corretores_lancados');
    }
};
