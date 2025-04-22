<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidos extends Model
{
    use HasFactory, softDeletes;

    public $preventsLazyLoading = true;

    protected $table = 'pedidos';

    protected $with = ['clientes', 'motoristas', 'fornecedor', 'produtos', 'caminhao'];

    protected $fillable = [
        'id_cliente', 'logradouro', 'numero', 'complemento', 'bairro',
        'cidade', 'estado', 'id_fornecedor', 'id_produto', 'valor',
        'id_motorista', 'id_caminhao', 'pago', 'data_entrega'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'id_fornecedor');
    }

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }

    public function motoristas()
    {
        return $this->belongsTo(Motorista::class, 'id_motorista');
    }

    public function caminhao()
    {
        return $this->belongsTo(Caminhao::class, 'id_caminhao');
    }
}
