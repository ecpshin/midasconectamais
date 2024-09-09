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
        Schema::table('propostas', function (Blueprint $table) {
            $table->foreignId('tabela_id')->after('liquido_proposta')->nullable()->constrained('tabelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('percentual_loja')->after('tabela_id')->nullable()->default(0);
            $table->bigInteger('percentual_agente')->after('percentual_loja')->nullable()->default(0);
            $table->bigInteger('percentual_corretor')->after('percentual_agente')->nullable()->default(0);
            $table->bigInteger('valor_loja')->after('percentual_corretor')->nullable()->default(0);
            $table->bigInteger('valor_agente')->after('valor_loja')->nullable()->default(0);
            $table->bigInteger('valor_corretor')->after('valor_agente')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('propostas', function (Blueprint $table) {
            $table->dropColumn('valor_corretor');
            $table->dropColumn('valor_agente');
            $table->dropColumn('valor_loja');
            $table->dropColumn('percentual_corretor');
            $table->dropColumn('percentual_agente');
            $table->dropColumn('percentual_loja');
            $table->dropForeign('tabela_id');
        });
        Schema::enableForeignKeyConstraints();
    }
};
