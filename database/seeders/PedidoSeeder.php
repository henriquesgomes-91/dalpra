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
        $motoristas = DB::table('motoristas')->pluck('id')->toArray();
        $caminhoes = DB::table('caminhao')->pluck('id')->toArray();

        $pedidos = [];

        for ($i = 0; $i < 250; $i++) {
            $pedidos[] = [
                'id_cliente' => Arr::random($clientes) ?: null,
                'logradouro' => 'Rua ' . ($i + 1),
                'numero' => rand(1, 100),
                'complemento' => 'Apto ' . rand(1, 10),
                'bairro' => 'Bairro ' . ($i + 1),
                'cidade' => rand(1, 10) < 5 ? 'Curitiba' : 'Colombo',
                'estado' => 'PR',
                'id_fornecedor' => Arr::random($fornecedores),
                'id_produto' => Arr::random($produtos),
                'valor' => rand(1, 1000),
                'id_motorista' => Arr::random($motoristas) ?: null,
                'id_caminhao' => Arr::random($caminhoes) ?: null,
                'pago' => rand(0, 1) ? 1 : 0,
                'data_entrega' => \Carbon\Carbon::create(2025, 4, 1)->addDays(rand(1, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Pedidos::insert($pedidos);
    }
}
