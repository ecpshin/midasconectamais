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
            $table->unsignedDecimal('percentual', 8, 4);
            $table->foreignId('correspondente_id')->constrained('correspondentes', 'id')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('financeira_id')->constrained('financeiras', 'id')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
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
