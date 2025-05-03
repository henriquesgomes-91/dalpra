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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_motorista')->constrained('motoristas');
            $table->foreignId('id_item_pedido')->constrained('item_pedido');
            $table->foreignId('id_caminhao')->constrained('caminhao');
            $table->boolean('pago')->default(false);
            $table->date('data_entrega');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
