<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['id_motorista']);
            $table->dropForeign(['id_caminhao']);
            $table->dropForeign(['id_fornecedor']);
            $table->dropForeign(['id_produto']);
            $table->dropColumn(['data_entrega', 'pago', 'id_motorista', 'id_caminhao', 'id_fornecedor', 'id_produto']);
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->date('data_entrega')->nullable();
            $table->boolean('pago')->nullable();
            $table->unsignedBigInteger('id_motorista')->nullable();
            $table->unsignedBigInteger('id_caminhao')->nullable();
            $table->unsignedBigInteger('id_fornecedor')->nullable();
            $table->unsignedBigInteger('id_produto')->nullable();

            // Adicionar as constraints de chave estrangeira novamente
            $table->foreign('id_motorista')->references('id')->on('motoristas');
            $table->foreign('id_caminhao')->references('id')->on('caminhao');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedor');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }
};
