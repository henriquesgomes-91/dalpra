<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [];

        for ($i = 0; $i < 10; $i++) {
            $clientes[] = [
                'nome' => 'Cliente ' . ($i + 1),
                'email' => 'cliente' . ($i + 1) . '@exemplo.com',
                'telefone' => '12345' . rand(1000, 9999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Cliente::insert($clientes);
    }
}
