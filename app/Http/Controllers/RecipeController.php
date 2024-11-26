<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class RecipeController extends Controller
{
  // Listar todas as receitas
  public function index()
  {
    $recipes = Recipe::all();

    return response()->json($recipes);
  }

  // Exibir uma receita específica
  public function show($id)
  {
    try{
      $recipe =
      Recipe::findOrFail($id);
      return response()->json($recipe);
    }catch(\Exception $e){
      return response()->json(['error' => 'Receita não encontrada'], 404);
    }
  }

  // Criar uma nova receita
  public function store(Request $request)
  {
    try{
      $data = $request->all();

      $this->validate($request, [
        'title' => 'required|string|max:255',
        'time' => 'required|string',
        'recipe_yield' => 'required|integer',
        'ingredients' => 'required|string',
        'preparation_method' => 'required|string',
        'tips' => 'string',
        'category_id' => 'required|integer',
      ]);

      return Recipe::create($data);

    }catch(\Exception $e){
      return response()->json(['error' => 'Erro ao criar receita, tente novamente mais 
       tarde!'], 404);
    }
    
  }

  // Atualizar uma receita
  public function update(Request $request, $id)
  {

    $data = $request->all();


      $validator = Validator::make($data, [
        'title' => 'required|string|max:255',
        'time' => 'required|string',
        'recipe_yield' => 'required|integer',
        'ingredients' => 'required|string',
        'preparation_method' => 'required|string',
        'tips' => 'string',
        'category_id' => 'required|integer',
    ]);

      if ($validator->fails()) {
        return response(['error' => $validator->errors(), 'message' => 'Validation Error'], 400);
      }

      $recipe = Recipe::findOrFail($id);
      $recipe->update($data);
      return response()->json($recipe);
  }

  // Deletar uma receita
  public function destroy($id)
  {
    $recipe = Recipe::findOrFail($id);
    $recipe->delete();

    return response()->json(['message' => 'Receita deletada com sucesso!']);
  }

  // Filtrar receitas por categoria
  public function filter(Request $request)
  {
    $query = Recipe::query();

    if ($request->has('name')) {
      $query->where('title', 'LIKE', '%' . $request->name . '%');
    }

    if ($request->has('category_id')) {
      $query->where('category_id', $request->category_id);
    }

    if ($request->has('category')) {
      $query->whereHas('category', function ($q) use ($request) {
        $q->where('name', 'LIKE', '%' . $request->category . '%');
      });
    }

    $recipes = $query->get();
    return response()->json($recipes);
  }

}

