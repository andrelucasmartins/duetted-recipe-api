<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
  // Listar todas as receitas
  public function index()
  {
    $recipes = Receita::all();

    return response()->json($recipes);
  }

  // Exibir uma receita específica
  public function show($id)
  {
    $recipe =
    Receita::findOrFail($id);
    return response()->json($recipe);
  }

  // Criar uma nova receita
  public function store(Request $request)
  {
    $data = $request->all();

    $this->validate($request,[
      'titulo' => 'required|string|max:255',
      'descricao' => 'required|string',
      'ingredientes' => 'required|string',
      'preparo' => 'required|string',
    ]);

    return Receita::create($data);
  }

  // Atualizar uma receita
  public function update(Request $request, $id)
  {
    $data = $request->all();
    $receita = Receita::findOrFail($id);

    $this->validate(
      $request,[
      'titulo' => 'required|string|max:255',
      'descricao' => 'required|string',
      'ingredientes' => 'required|string',
      'preparo' => 'required|string',
    ]);

    $receita->update($data);

    return response()->json($receita);
  }

  // Deletar uma receita
  public function destroy($id)
  {
    $receita = Receita::findOrFail($id);
    $receita->delete();

    return response()->json(['message' => 'Receita deletada com sucesso!']);
  }
}
