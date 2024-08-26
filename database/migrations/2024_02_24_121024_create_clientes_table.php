Cliente<?php

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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('cpf', 50)->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('rg', 50)->nullable()->default('Não informado');
            $table->string('orgao_exp', 50)->nullable()->default('Não informado');
            $table->date('data_exp')->nullable();
            $table->string('naturalidade', 100)->nullable()->default('Não informado');
            $table->string('genitora', 100)->nullable()->default('Não informado');
            $table->string('genitor', 100)->nullable()->default('Não informado');
            $table->string('sexo', 50)->nullable()->default('Masculino');
            $table->string('estado_civil', 50)->nullable()->default('Casado');
            $table->string('phone1', 50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone2', 50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone3', 50)->nullable()->default('(84)9 9999-9999');
            $table->string('phone4', 50)->nullable()->default('(84)9 9999-9999');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
