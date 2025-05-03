<?php

namespace Database\Seeders;

use App\Models\Entrega;
use App\Models\ItemPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objItens = ItemPedido::whereNull('id_entrega')->get();
        $motoristas = DB::table('motoristas')->pluck('id')->toArray();
        $caminhoes = DB::table('caminhao')->pluck('id')->toArray();

        foreach ($objItens as $item) {
            $objEntrega = Entrega::create([
                'id_motorista' => Arr::random($motoristas) ?: null,
                'id_caminhao' => Arr::random($caminhoes) ?: null,
                'pago' => rand(0, 1),
                'data_entrega' => $this->generateRandomDate('2025-05-01', '2025-05-31'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $item->update([
                'id_entrega' => $objEntrega->id
            ]);
        }
    }

    private function generateRandomDate($startDate, $endDate)
    {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);
        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
        return date('Y-m-d', $randomTimestamp);
    }
}
