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
        Schema::table('contrato_empresarial', function (Blueprint $table) {
            $table->string('desconto_operadora', 50)->default('0')->after('plano_contrado'); // Substitua 'some_existing_column' pelo nome da coluna existente após a qual você deseja adicionar o campo
            $table->integer('quantidade_parcelas')->default(0)->after('desconto_operadora');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrato_empresarial', function (Blueprint $table) {
            $table->dropColumn('desconto_operadora');
            $table->dropColumn('quantidade_parcelas');
        });
    }
};
