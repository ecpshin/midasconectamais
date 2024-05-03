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
        Schema::create('vinculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('organizacao_id')->constrained('organizacoes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nrbeneficio')->nullable()->default('Não informado');
            $table->string('email')->nullable()->default('cliente@email.com');
            $table->string('senha')->nullable()->default('********');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('vinculos');
        Schema::enableForeignKeyConstraints();
    }
};
