<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caminhao extends Model
{
    use HasFactory, SoftDeletes;

    public $preventsLazyLoading = true;

    protected $table = 'caminhao';

    protected $fillable = ['id', 'descricao', 'placa'];
}
