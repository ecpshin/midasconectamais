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
        Schema::table('tabelas', function (Blueprint $table) {
            $table->string('descricao_codigo')->virtualAs('CONCAT(descricao,\' - \', codigo)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabelas', function (Blueprint $table) {
            $table->dropColumn('descricao_codigo');
        });
    }
};
