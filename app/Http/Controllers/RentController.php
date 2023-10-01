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
            1 => 'Libre',
            2 => 'Alquilado',
            3 => 'Mantenimiento'
        ];
        $admin['section'] = 'rents';
        return view('admin.listRents', compact('rents', 'clients', 'categories', 'date_start', 'date_end', 'client', 'status', 'healties', 'statuses', 'admin'));
    }


}