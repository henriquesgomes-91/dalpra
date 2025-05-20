<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produto_fornecedor', function (Blueprint $table) {
            $table->renameColumn('valor', 'custo');
            $table->decimal('preco_venda', 10, 2)->nullable(); // Ajuste o tamanho e a precisão conforme necessário
        });
    }

    public function down()
    {
        Schema::table('produto_fornecedor', function (Blueprint $table) {
            // Reverter a renomeação
            $table->renameColumn('custo', 'valor');

            // Remover a coluna 'preco_venda'
            $table->dropColumn('preco_venda');
        });
    }
};
