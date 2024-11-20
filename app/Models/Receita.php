<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
  // Defina a tabela, se o nome for diferente de 'receitas'
  protected $table = 'receitas';

  // Campos que podem ser preenchidos
  protected $fillable = [
    'titulo',
    'descricao',
    'ingredientes',
    'preparo'];

  // Se você não usar timestamps, desabilite-os
  public $timestamps = false;
}
