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
        Schema::create('corretoras', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->unique();
            $table->string('logo', 255)->nullable();
            $table->string('endereco', 255)->nullable();
            $table->string('telefone', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->decimal('consultas_eletivas_coletivo', 10, 2)->nullable();
            $table->decimal('consultas_urgencia_coletivo', 10, 2)->nullable();
            $table->decimal('exames_simples_coletivo', 10, 2)->nullable();
            $table->decimal('exames_complexos_coletivo', 10, 2)->nullable();
            $table->decimal('terapias_coletivo', 10, 2)->nullable();
            $table->decimal('consultas_eletivas_individual', 10, 2)->nullable();
            $table->decimal('consultas_urgencia_individual', 10, 2)->nullable();
            $table->decimal('exames_simples_individual', 10, 2)->nullable();
            $table->decimal('exames_complexos_individual', 10, 2)->nullable();
            $table->decimal('terapias_individual', 10, 2)->nullable();
            $table->string('linha_01_coletivo', 255)->nullable();
            $table->string('linha_02_coletivo', 255)->nullable();
            $table->string('linha_03_coletivo', 255)->nullable();
            $table->string('linha_01_individual', 255)->nullable();
            $table->string('linha_02_individual', 255)->nullable();
            $table->string('linha_03_individual', 255)->nullable();
            $table->string('cor', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corretoras');
    }
};
