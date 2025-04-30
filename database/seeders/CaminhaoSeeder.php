<?php

namespace Database\Seeders;

use App\Models\Caminhao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaminhaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caminhoes = [];

        for ($i = 0; $i < 10; $i++) {
            $caminhoes[] = [
                'descricao' => 'Caminhão ' . ($i + 1),
                'placa' => strtoupper(uniqid('ABC-')),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Caminhao::insert($caminhoes);
    }
}
