<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('itens_auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditoria_id')->constrained()->onDelete('cascade');
            $table->string('tipo');  // 'Ponto Auditado', 'Orientação Realizada', etc.
            $table->text('descricao');
            $table->string('imagem')->nullable();  // Caminho da imagem
            $table->integer('ordem');  // Ordem do item na auditoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_auditoria');
    }
};
