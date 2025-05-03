<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->integer('quantidade')->default(0); // Adiciona a coluna quantidade com valor padrão 1
        });
    }

    public function down()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->dropColumn('quantidade'); // Remove a coluna
        });
    }
};
