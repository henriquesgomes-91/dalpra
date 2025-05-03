<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrega extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'entregas';

    protected $with = ['motoristas', 'caminhao'];

    protected $fillable = [
        'id_motorista', 'id_caminhao', 'pago', 'data_entrega'
    ];

    public function motoristas()
    {
        return $this->belongsTo(Motorista::class, 'id_motorista');
    }

    public function caminhao()
    {
        return $this->belongsTo(Caminhao::class, 'id_caminhao');
    }

    public function itemPedido()
    {
        return $this->hasMany(ItemPedido::class, 'id_entrega');
    }
}
