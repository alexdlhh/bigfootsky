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


class ColaboratorsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * esta funcion carga la vista de los colaboradores
     * @param string name
     * @return \Illuminate\View\View
     */
    public function index($name = null)
    {
        $query = Colaborators::query();

        if($name !== null){
            $query->where('name', 'like', '%'.$name.'%');
        }

        $colaborators = $query->get();
        $admin['section'] = 'colaborators';
        return view('admin.listColaborators', compact('colaborators', 'admin'));
    }

    /**
     * vista de crear colaborador
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $colaborators = null;
        if($id != null){
            $colaborators = Colaborators::find($id);
        }
        $admin['section'] = 'colaborators';
        return view('admin.editColaborators', compact('colaborators', 'admin'));
    }

    /**
     * esta funcion guarda el colaborador
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $colaborators = null;
            if($request->id != 0){
                $colaborators = Colaborators::find($request->id);
            }else{
                $colaborators = new Colaborators();
            }
            $colaborators->name = $request->name;
            $colaborators->discount = $request->discount;
            $colaborators->employees = $request->employee;
            $colaborators->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar la clase colaborador: '.$e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Colaborador guardado correctamente', 'id' => $colaborators->id]);
    }

    /**
     * esta funcion elimina el colaborador
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $colaborators = Colaborators::find($request->id);
            $colaborators->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar la clase colaborador']);
        }
        return response()->json(['success' => true, 'message' => 'Colaborador eliminado correctamente']);
    }
}
