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
        Schema::create('comissoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposta_id')->constrained('propostas', 'id');
            $table->foreignId('tabela_id')->constrained('tabelas', 'id')->default(1);
            $table->decimal('percentual_loja', 20, 2)->nullable()->default(0.0);
            $table->decimal('percentual_agente', 20, 2)->nullable()->default(0.0);
            $table->decimal('percentual_corretor', 20, 2)->nullable()->default(0.0);
            $table->decimal('valor_loja', 20, 2)->nullable()->default(0.0);
            $table->decimal('valor_agente', 20, 2)->nullable()->default(0.0);
            $table->decimal('valor_corretor', 20, 2)->nullable()->default(0.0);
            $table->boolean('is_pago')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissoes');
    }
};
