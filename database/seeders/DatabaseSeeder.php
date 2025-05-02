<?php

namespace Database\Seeders;

use App\Models\Caminhao;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Motorista;
use App\Models\Pedidos;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(CaminhaoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(FornecedorSeeder::class);
        $this->call(MotoristaSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(PedidoSeeder::class);
        $this->call(ProdutoFornecedorSeeder::class);
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
