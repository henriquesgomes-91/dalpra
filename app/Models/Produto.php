<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = ['descricao', 'tipo_produto' ,'unidade_medida'];

    // Definindo a relação com ProdutoXFornecedor
    public function produtoFornecedor()
    {
        return $this->hasMany(ProdutoFornecedor::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_produto');
    }
}
