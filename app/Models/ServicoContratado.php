<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoContratado extends Model
{
    use HasFactory;

    protected $table = 'servicos_contratados';
    protected $fillable = ['cliente_id', 'servico_id'];
}
