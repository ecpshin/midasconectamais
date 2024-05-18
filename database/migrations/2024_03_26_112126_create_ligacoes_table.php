<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('status_id')->constrained('statuses', 'id');
            $table->foreignId('organizacao_id')->constrained('organizacoes', 'id');
            $table->foreignId('produto_id')->constrained('produtos', 'id');
            $table->date('data_ligacao')->nullable();
            $table->date('data_agendamento')->nullable();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('matricula')->nullable()->default('000');
            $table->decimal('margem', 20, 6)->nullable()->default('0.000000');
            $table->string('telefone')->nullable()->default('(84)9 0000-0000');
            $table->string('orgao')->nullable()->default('Não informado');
            $table->string('produto')->nullable()->default('Não informado');
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligacoes');
    }
};
