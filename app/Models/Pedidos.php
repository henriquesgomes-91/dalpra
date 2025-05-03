<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidos extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'pedidos';

    protected $with = ['clientes'];

    protected $fillable = [
        'id_cliente', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'valor'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function itemPedido()
    {
        return $this->hasMany(ItemPedido::class, 'id_pedido');
    }
}
