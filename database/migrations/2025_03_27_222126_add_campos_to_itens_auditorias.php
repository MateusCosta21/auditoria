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
        Schema::table('itens_auditoria', function (Blueprint $table) {
            $table->string('setor')->nullable(); // Nome do setor
            $table->date('realizada_em')->nullable(); // Data de realização
            $table->date('prazo_estabelecido')->nullable(); // Prazo
        });
    }
    
    public function down()
    {
        Schema::table('itens_auditoria', function (Blueprint $table) {
            $table->dropColumn(['setor', 'realizada_em', 'prazo_estabelecido']);
        });
    }
};
