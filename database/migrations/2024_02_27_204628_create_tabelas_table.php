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
            $table->foreignId('produto_id')->constrained('produtos', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('correspondente_id')->constrained('correspondentes', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('financeira_id')->constrained('financeiras', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('descricao');
            $table->string('codigo');
            $table->decimal('percentual_loja', 20, 2);
            $table->decimal('percentual_agente', 20, 2);
            $table->decimal('percentual_corretor', 20, 2);
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
