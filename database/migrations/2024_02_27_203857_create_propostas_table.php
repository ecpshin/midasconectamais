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
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('numero_contrato', 50)->nullable()->default('Não informado');
            $table->date('data_digitacao')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->integer('prazo_proposta')->nullable()->default(0);
            $table->decimal('total_proposta', 20, 2)->nullable();
            $table->decimal('parcela_proposta', 20, 2)->nullable();
            $table->decimal('liquido_proposta', 20, 2)->nullable();
            $table->foreignId('cliente_id')->constrained('clientes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('produto_id')->constrained('produtos', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('financeira_id')->constrained('financeiras', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('correspondente_id')->constrained('correspondentes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('situacao_id')->constrained('situacoes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
