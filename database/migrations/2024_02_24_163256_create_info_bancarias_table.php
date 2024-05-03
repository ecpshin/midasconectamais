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
        Schema::create('info_bancarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes', 'id')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('codigo', 50)->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia', 50)->nullable();
            $table->string('conta', 50)->nullable();
            $table->string('tipo',  50)->nullable();
            $table->string('operacao',  100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_bancarias');
    }
};
