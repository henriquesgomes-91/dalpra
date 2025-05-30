<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = ['id', 'nome', 'email', 'telefone'];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_cliente');
    }
}
