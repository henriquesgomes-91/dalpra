<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    public $preventsLazyLoading = true;

    protected $table = 'fornecedor';

    protected $with = ['produtoFornecedor'];

    protected $fillable = ['razao_social', 'cnpj'];

    public function produtoFornecedor()
    {
        return $this->hasMany(ProdutoFornecedor::class, 'id_fornecedor');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_fornecedor');
    }
}
