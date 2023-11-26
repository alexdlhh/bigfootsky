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


class RentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the rents
     * it can be filtered by date, product, client or status
     * @param date date
     * @return \Illuminate\View\View
     */
    public function index($date_start = null, $date_end = null, $client = null, $status = null)
    {
        $clients = Client::all();
        $categories = Category::all();
        $rents = Rent::all();

        $rent_aux = [];

        foreach($rents as $rent){
            $find = true;
            if($date_start != null){
                if($rent->date_start >= $date_start){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($date_end != null){
                if($rent->date_end <= $date_end){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($client != null){
                if($rent->client_id == $client){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($status != null){
                if($rent->status == $status){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($find){
                $rent_aux[] = $rent;
            }
        }

        $rents = $rent_aux;
        $healties = [
            1 => 'Peligroso',
            2 => 'Muy Malo',
            3 => 'Malo',
            4 => 'Desperfecto Grave',
            5 => 'Desperfecto Leve',
            6 => 'Regular',
            7 => 'Usado',
            8 => 'Bueno',
            9 => 'Muy Bueno',
            10 => 'Nuevo'
        ];
        $statuses = [
            1 => 'Alquilado',
            2 => 'Finalizado'
        ];
        $admin['section'] = 'rents';
        return view('admin.listRents', compact('rents', 'clients', 'categories', 'date_start', 'date_end', 'client', 'status', 'healties', 'statuses', 'admin'));
    }

    /**
     * this function will load the view of the rent
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $rent = null;
        $rent = [];
        $product = [];
        $client = [];
        $products = Product::whereNotIn('id', Rent::where('status', 1)->pluck('product_id'))->get();
        $clients = Client::all();
        if($id != 0){
            $rent = Rent::find($id);
            $product = !empty($rent->product_id)?Product::find($rent->product_id):[];
            $client = Client::find($rent->client_id);
        }
        $admin['section'] = 'rents';
        return view('admin.editRent', compact('rent', 'products', 'product', 'clients', 'client', 'admin'));
    }

    /**
     * this function will save the rent
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $rent = null;
            if($request->id != 0){
                $rent = Rent::find($request->id);
            }else{
                $rent = new Rent();
            }
            $rent->product_id = $request->product_id;
            $rent->client_id = $request->client_id;
            $rent->time_start = $request->time_start;
            $rent->time_end = $request->time_end;
            $rent->date = $request->date;
            $rent->price = $request->price;
            $rent->status = $request->status;
            $rent->save();
            if(!empty($request->product_id)){
                $product = Product::find($request->product_id);
                $product->status =$rent->status==1?2:1;
                $product->save();
            }
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Alquiler guardado correctamente', 'id' => $rent->id]);
    }

    /**
     * this function will delete the rent
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $rent = Rent::find($request->id);
            $rent->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el alquiler']);
        }
        return response()->json(['success' => true, 'message' => 'Alquiler eliminado correctamente']);
    }
}
