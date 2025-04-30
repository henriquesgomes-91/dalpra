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
                $produtosFornecedores[] = [
                    'id_produto' => $produtoId,
                    'id_fornecedor' => $fornecedorId,
                    'valor' => rand(1, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ProdutoFornecedor::insert($produtosFornecedores);
    }
}
