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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('cpf', 50)->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('phone', 25)->nullable()->default('(84) 9 9999-0000');
            $table->string('codigo', 25)->nullable();
            $table->string('banco', 255)->nullable();
            $table->string('conta', 50)->nullable();
            $table->string('agencia', 25)->nullable();
            $table->string('tipo_conta', 50)->nullable()->default('Conta Corrente');
            $table->string('codigo_op', 50)->nullable()->default('000');
            $table->string('tipo_chave_pix', 50)->nullable()->default('Não informado');
            $table->string('chave_pix', 255)->nullable()->default('Não informado');
            $table->string('path')->nullable()->default('img/users/user.png');
            $table->string('tipo', 50)->nullable()->default('agente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
