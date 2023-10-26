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
        Schema::create('aluno_turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
		$table->unsignedBigInteger('turma_id');
		$table->foreign('aluno_id')->references('id')->on('aluno')->onDelete('cascade');
		$table->foreign('turma_id')->references('id')->on('turma')->onDelete('cascade');
		
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno_turmas');
    }
};
