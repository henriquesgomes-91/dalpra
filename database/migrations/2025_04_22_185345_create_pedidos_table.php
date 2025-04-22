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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->nullable()->constrained('clientes')->onDelete('set null');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->foreignId('id_fornecedor')->constrained('fornecedor');
            $table->foreignId('id_produto')->constrained('produtos');
            $table->double('valor', 9, 2);
            $table->foreignId('id_motorista')->constrained('motoristas');
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
        Schema::dropIfExists('pedidos');
    }
};
