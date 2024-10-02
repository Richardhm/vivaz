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
        Schema::create('metas', function(Blueprint $table) {
            $table->id(); // ID da tabela (chave primária)

            // Chave estrangeira para a tabela users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Chave estrangeira para a tabela corretoras
            $table->unsignedBigInteger('corretora_id');
            $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade');

            // Campos para metas
            $table->integer('individual')->default(0); // Meta individual, default 0
            $table->integer('super_simples')->default(0); // Meta super simples, default 0
            $table->integer('coletivo')->default(0); // Meta coletivo, default 0

            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
