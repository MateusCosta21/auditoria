<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensItensAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_itens_auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_auditoria_id')->constrained('itens_auditoria')->onDelete('cascade');
            $table->string('caminho_imagem'); 
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
        Schema::dropIfExists('imagens_itens_auditoria');
    }
}
