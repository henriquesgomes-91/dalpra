<?php

namespace App\Helpers;
class Tools {
    public static function formatarUnidadeMedida(string $unidade): string
    {
        $unidades = [
            'H' => 'Horas',
            'UN' => 'Unidades',
            'KG' => 'Kilos',
            'MT' => 'Metros',
            'MT3' => 'Metro Cúbico'
        ];

        return $unidades[$unidade] ?? $unidade;
    }

    public static function formatarUnidadeMedidaAbreviada(string $unidade): string
    {
        $unidades = [
            'H' => 'Horas',
            'UN' => 'UN',
            'KG' => 'KG',
            'MT' => 'M',
            'MT3' => 'MT³'
        ];

        return $unidades[$unidade] ?? $unidade;
    }
}
