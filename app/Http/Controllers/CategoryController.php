<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{

  public function index() {
    $categories = Category::all();

    return response()->json($categories);
  }

  public function show($id)
  {
    
    try{
        $category = Category::findOrFail($id);
        return response()->json($category);
      }catch(\Exception $e){
        return response()->json(['error' => 'Categoria não encontrada'], 404);
      }
  }

  public function store(Request $request)
  {

    try{
    $data = $request->all();

    $this->validate($request, [
      'name' => 'required|string|max:255',
    ]);

    return Category::create($data);
    }catch(\Exception $e){
      return response()->json(['error' => 'Erro ao criar categoria, tente novamente mais
       tarde!'], 404);
    }
  }

  public function update(Request $request, $id)
  {
    $data = $request->all();
    $category = Category::findOrFail($id);

    $this->validate(
      $request,
      [
        'name' => 'required|string|max:255',
      ]
    );

    $category->update($data);

    return response()->json($category);
  }


  public function destroy($id)
  {
    $category = Category::findOrFail($id);
    $category->delete();

    return response()->json(['message' => 'Categoria deletada com sucesso!']);
  }

}