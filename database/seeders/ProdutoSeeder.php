<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = [];

        for ($i = 0; $i < 10; $i++) {
            $produtos[] = [
                'descricao' => 'Produto ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Produto::insert($produtos);
    }
}
