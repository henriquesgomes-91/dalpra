<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    public $preventsLazyLoading = true;

    protected $table = 'item_pedido';

    protected $with = ['pedidos', 'fornecedor', 'produtos'];

    protected $fillable = ['id_pedido', 'id_fornecedor', 'id_produto', 'valor'];

    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'id_fornecedor');
    }

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }

    public function entregas()
    {
        return $this->hasMany(Pedidos::class, 'id_item_pedido');
    }
}
