<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->dropForeign(['id_item_pedido']); // Remove a chave estrangeira, se existir
            $table->dropColumn('id_item_pedido'); // Remove a coluna
        });
    }

    public function down()
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->foreignId('id_item_pedido')->constrained('item_pedidos')->onDelete('cascade'); // Recria a coluna se necessário
        });
    }
};
