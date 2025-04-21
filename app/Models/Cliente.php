<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    public $preventsLazyLoading = true;

    protected $table = 'clientes';

    protected $fillable = ['id', 'nome', 'email', 'telefone'];
}
