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
        Schema::create('tabelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('financeira_id')->constrained('financeiras', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('correspondente_id')->constrained('correspondentes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('organizacao_id')->constrained('organizacoes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('descricao');
            $table->string('codigo');
            $table->string('prazo')->nullable()->default('0');
            $table->decimal('percentual_loja', 20, 2);
            $table->decimal('percentual_diferido', 20, 2);
            $table->decimal('percentual_agente', 20, 2);
            $table->decimal('percentual_corretor', 20, 2);
            $table->string('referencia')->nullable()->default('L');
            $table->boolean('parcelado')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabelas');
    }
};
