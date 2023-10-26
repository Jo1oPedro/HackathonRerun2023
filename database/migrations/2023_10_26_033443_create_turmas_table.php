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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('codigoTurma', 191);
		$table->unsignedBigInteger('professor_id');
		$table->foreign('professor_id')->references('id')->on('professor')->onDelete('cascade');
		$table->unsignedBigInteger('endereco_id');
		$table->foreign('endereco_id')->references('id')->on('endereco')->onDelete('cascade');
		$table->unsignedBigInteger('escola_id');
		$table->foreign('escola_id')->references('id')->on('escola')->onDelete('cascade');
		
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
