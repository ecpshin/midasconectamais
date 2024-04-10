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
        Schema::create('mailings', function (Blueprint $table) {
            $table->id();
            $table->date('data_consulta')->nullable();
            $table->string('nome')->nullable();
            $table->string('cpf')->nullable();
            $table->string('matricula')->nullable();
            $table->string('orgao')->nullable();
            $table->decimal('margem', 20, 2)->nullable()->default(0.0);
            $table->longText('observacoes')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailings');
    }
};
