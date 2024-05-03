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
        Schema::create('correspondentes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_correspondente', 255);
            $table->string('nome_responsavel', 50)->nullable();
            $table->string('phone_contato', 50)->nullable();
            $table->string('cpf_cnpj', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondentes');
    }
};
