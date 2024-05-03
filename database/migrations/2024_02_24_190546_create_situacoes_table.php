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
        Schema::create('situacoes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao_situacao', 255);
            $table->string('motivo_situacao', 100)->nullable()->default('Não se aplica');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situacoes');
    }
};
