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
use App\Models\Course;
use App\Models\Repair;

class RepairController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * esta funcion carga la vista de las reparaciones
     * @param string name
     * @return \Illuminate\View\View
     */
    public function index($name = null)
    {
        $query = Repair::query();

        if($name !== null){
            $query->where('name', 'like', '%'.$name.'%');
        }

        $repair = $query->get();
        $admin['section'] = 'repair';
        return view('admin.listRepair', compact('repair', 'admin'));
    }

    /**
     * vista de crear reparacion
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $repair = null;
        if($id != null){
            $repair = Repair::find($id);
        }
        $clients = Client::all();
        $admin['section'] = 'repair';
        return view('admin.editRepair', compact('repair', 'admin' , 'clients'));
    }

    /**
     * esta funcion guarda la reparacion
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $repair = null;
            if($request->id != 0){
                $repair = Repair::find($request->id);
            }else{
                $repair = new Repair();
            }
            $repair->name = $request->name;
            $repair->fecha_recogida = $request->fecha_recogida;
            $repair->fecha_entrega = $request->fecha_entrega;
            $repair->id_cliente = $request->id_cliente;
            $repair->status = $request->status;
            $repair->precio = $request->precio;
            $repair->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar la solicitud de reparación: '.$e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Solicitud de reparación guardada correctamente', 'id' => $repair->id]);
    }

    /**
     * esta funcion elimina la reparacion
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $repair = Repair::find($request->id);
            $repair->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar la solicitud de reparación']);
        }
        return response()->json(['success' => true, 'message' => 'Solicitud de reparación eliminada correctamente']);
    }
}