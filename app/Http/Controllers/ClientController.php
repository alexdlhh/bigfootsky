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
use App\Models\Course;
use App\Models\Particular;
use App\Models\Teacher;


class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the clients
     * it can be filtered by fullname, dni, email or phone
     * @param String fullname
     * @return \Illuminate\View\View
     */
    public function index($fullname = null, $dni = null, $email = null, $phone = null){
        $query = Client::query();

        if($fullname !== null){
            $query->where('name', 'like', '%'.$fullname.'%')
                ->orWhere('surname', 'like', '%'.$fullname.'%');
        }

        if($dni !== null){
            $query->where('dni', 'like', '%'.$dni.'%');
        }

        if($email !== null){
            $query->where('email', 'like', '%'.$email.'%');
        }

        if($phone !== null){
            $query->where('phone', 'like', '%'.$phone.'%');
        }

        $clients = $query->get();
        $admin['section'] = 'clients';

        return view('admin.listClients', compact('clients', 'admin', 'fullname', 'dni', 'email', 'phone'));
    }

    /**
     * this function will load the view of the client
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $client = Client::find($id);
        $admin['section'] = 'rents';
        return view('admin.editClient', compact('admin', 'client'));
    }

    /**
     * this function will save the client
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $client = null;
            if($request->id != 0){
                $client = Client::find($request->id);
            }else{
                $client = new Client();
            }
            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->dni = $request->dni;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->birthdate = $request->birthdate;
            $client->height = $request->height;
            $client->weight = $request->weight;
            $client->shoe_size = $request->shoe_size;
            $client->ski_level = $request->ski_level;
            $client->snow_level = $request->snow_level;
            $client->snow_front = $request->snow_front;
            $client->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar el cliente']);
        }
        return response()->json(['success' => true, 'message' => 'Cliente guardado correctamente']);
    }

    /**
     * this function will delete the client
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $client = Client::find($request->id);
            $client->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el cliente']);
        }
        return response()->json(['success' => true, 'message' => 'Cliente eliminado correctamente']);
    }
}
