<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoFornecedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produto_fornecedor';

    protected $fillable = ['id_fornecedor', 'id_produto', 'custo', 'preco_venda'];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'id_fornecedor');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
