<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = DB::table('clientes')->pluck('id')->toArray();
        $fornecedores = DB::table('fornecedor')->pluck('id')->toArray();
        $produtos = DB::table('produtos')->pluck('id')->toArray();

        for ($i = 0; $i < 250; $i++) {
            $pedidos = [
                'id_cliente' => Arr::random($clientes) ?: null,
                'logradouro' => 'Rua ' . ($i + 1),
                'numero' => rand(1, 100),
                'complemento' => 'Apto ' . rand(1, 10),
                'bairro' => 'Bairro ' . ($i + 1),
                'cidade' => rand(1, 10) < 5 ? 'Curitiba' : 'Colombo',
                'estado' => 'PR',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $objPedido = Pedidos::create($pedidos);

            $contadorTotal = 0;
            for ($j = 0; $j < rand(1, 10); $j++) {
                $valorProduto = rand(1, 100);
                DB::table('item_pedido')->insert([
                    'id_pedido' => $objPedido->id,
                    'id_fornecedor' => Arr::random($fornecedores),
                    'id_produto' => Arr::random($produtos),
                    'quantidade' => rand(1, 10),
                    'valor' => $valorProduto,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $contadorTotal += $valorProduto;
            }
            $objPedido->update(['valor' => $contadorTotal]);
        }
    }
}
