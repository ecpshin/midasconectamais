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
            $table->foreignId('cliente_id')->constrained('clientes', 'id');
            $table->foreignId('organizacao_id')->constrained('organizacoes', 'id');
            $table->string('nrbeneficio')->nullable()->default('Não informado');
            $table->string('phone1',50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone2',50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone3',50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone4',50)->nullable()->default('(84)9 9999-9999');
            $table->text('emails_senhas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vinculos');
    }
};
