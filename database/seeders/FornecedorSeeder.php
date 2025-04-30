<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedores = [];

        for ($i = 0; $i < 10; $i++) {
            $fornecedores[] = [
                'razao_social' => 'Fornecedor ' . ($i + 1),
                'cnpj' => '123456780001' . rand(0, 9),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Fornecedor::insert($fornecedores);
    }
}
