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
            $table->string('descricao');
            $table->string('codigo');
            $table->string('produto');
            $table->decimal('percentual_loja', 8, 4);
            $table->decimal('percentual_agente', 8, 4);
            $table->decimal('percentual_corretor', 8, 4);
            $table->foreignId('correspondente_id')->constrained('correspondentes', 'id')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('financeira_id')->constrained('financeiras', 'id')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
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
