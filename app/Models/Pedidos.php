<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidos extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'pedidos';

    protected $with = ['clientes', 'motoristas', 'caminhao'];

    protected $fillable = [
        'id_cliente', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'id_motorista', 'id_caminhao', 'pago', 'data_entrega'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

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
        return $this->hasMany(ItemPedido::class, 'id_pedido');
    }
}
