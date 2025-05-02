<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Remover as colunas
            $table->dropColumn(['valor', 'data_entrega', 'pago', 'id_motorista', 'id_caminhao', 'id_fornecedor', 'id_produto']);
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Recriar as colunas se necessário
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_entrega')->nullable();
            $table->boolean('pago')->nullable();
            $table->unsignedBigInteger('id_motorista')->nullable();
            $table->unsignedBigInteger('id_caminhao')->nullable();
            $table->unsignedBigInteger('id_fornecedor')->nullable();
            $table->unsignedBigInteger('id_produto')->nullable();

            // Adicionar as constraints de chave estrangeira novamente
            $table->foreign('id_motorista')->references('id')->on('motoristas');
            $table->foreign('id_caminhao')->references('id')->on('caminhoes');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedores');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }
};
