<?php

namespace Database\Seeders;

use App\Models\ProdutoFornecedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoFornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = DB::table('produtos')->pluck('id');
        $fornecedores = DB::table('fornecedor')->pluck('id');

        $produtosFornecedores = [];

        foreach ($produtos as $produtoId) {
            foreach ($fornecedores as $fornecedorId) {
                $preco = rand(1, 1000);
                $produtosFornecedores[] = [
                    'id_produto' => $produtoId,
                    'id_fornecedor' => $fornecedorId,
                    'preco_venda' => $preco + rand(100, 200),
                    'custo' => $preco,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ProdutoFornecedor::insert($produtosFornecedores);
    }
}
