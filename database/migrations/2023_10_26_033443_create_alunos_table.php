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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 191);
		$table->unsignedBigInteger('professor_id');
		$table->foreign('professor_id')->references('id')->on('professor')->onDelete('cascade');
		$table->unsignedBigInteger('turma_id');
		$table->foreign('turma_id')->references('id')->on('turma')->onDelete('cascade');
		
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
