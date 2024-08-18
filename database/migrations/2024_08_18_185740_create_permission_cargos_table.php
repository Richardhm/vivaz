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
        Schema::create('permission_cargos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permission_id')->unsigned();
            $table->bigInteger('cargo_id')->unsigned();
            $table->timestamps();

            // Adicionar chaves estrangeiras
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_cargos');
    }
};
