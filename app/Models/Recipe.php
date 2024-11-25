<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
  // Defina a tabela, se o nome for diferente de 'receitas'
  protected $table = 'recipes';

  // Campos que podem ser preenchidos
  protected $fillable = [
    'title',
    'time',
    'recipe_yield',
    'ingredients',
    'preparation_method',
    'tips',
    'category_id'
  ];

  // Se você não usar timestamps, desabilite-os
  public $timestamps = true;
}
