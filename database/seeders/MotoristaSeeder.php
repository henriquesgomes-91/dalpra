<?php

namespace Database\Seeders;

use App\Models\Motorista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotoristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motoristas = [];

        for ($i = 0; $i < 10; $i++) {
            $motoristas[] = [
                'nome' => 'Motorista ' . ($i + 1),
                'comissao' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Motorista::insert($motoristas);
    }
}
