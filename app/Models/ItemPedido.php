<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    public $preventsLazyLoading = true;

    protected $table = 'item_pedido';

    protected $with = ['pedidos','entregas', 'fornecedor', 'produtos'];

    protected $fillable = ['id_pedido', 'id_fornecedor', 'id_produto', 'valor', 'id_entrega', 'quantidade'];

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
        return $this->belongsTo(Entrega::class, 'id_entrega'); // A relação com a chave estrangeira id_entrega
    }
}
