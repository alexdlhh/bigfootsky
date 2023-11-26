<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rent;
use App\Models\Client;
use App\Models\Particular;
use App\Models\Teacher;
use App\Models\Colaborators;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * esta funcion carga la vista de los categorias
     * @param string name
     * @return \Illuminate\View\View
     */
    public function index($name = null)
    {
        $query = Category::query();

        if($name !== null){
            $query->where('name', 'like', '%'.$name.'%');
        }

        $category = $query->get();
        $admin['section'] = 'category';
        return view('admin.listCategory', compact('category', 'admin'));
    }

    /**
     * vista de crear categoria
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $category = null;
        if($id != null){
            $category = Category::find($id);
        }
        $admin['section'] = 'category';
        return view('admin.editCategory', compact('category', 'admin'));
    }

    /**
     * esta funcion guarda la categoria
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $category = null;
            if($request->id != 0){
                $category = Category::find($request->id);
            }else{
                $category = new Category();
            }
            $category->name = $request->name;
            $category->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar la categoria: '.$e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Categoria guardada correctamente', 'id' => $category->id]);
    }

    /**
     * esta funcion elimina la categoria
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $category = Category::find($request->id);
            $category->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar la categoria']);
        }
        return response()->json(['success' => true, 'message' => 'Categoria eliminada correctamente']);
    }
}