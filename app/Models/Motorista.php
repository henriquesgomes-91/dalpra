<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorista extends Model
{
    use HasFactory, SoftDeletes;

    public $preventsLazyLoading = true;

    protected $table = 'motoristas';

    protected $fillable = ['nome', 'comissao'];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_motorista');
    }
}
