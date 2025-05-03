<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->foreignId('id_entrega')->nullable()->constrained('entregas');
        });
    }

    public function down()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->dropForeign(['id_entrega']); // Remove a chave estrangeira
            $table->dropColumn('id_entrega'); // Remove a coluna
        });
    }
};
