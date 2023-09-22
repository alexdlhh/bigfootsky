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
    public function index($date = null, $product = null, $client = null, $status = null)
    {
        $rents = Rent::all();
        $products = Product::all();
        $clients = Client::all();
        $categories = Category::all();

        // Fecha
        if ($date != null) {
            $rents = $rents->where('date', $date);
        }

        // Producto
        if ($product != null) {
            $rents = $rents->where('product_id', $product);
        }

        // Cliente
        if ($client != null) {
            $rents = $rents->where('client_id', $client);
        }

        // Estado
        if ($status != null) {
            $rents = $rents->where('status', $status);
        }

        // Combinaciones
        $combinations = array();

        if ($date != null) {
            $combinations[] = 'date';
        }

        if ($product != null) {
            $combinations[] = 'product_id';
        }

        if ($client != null) {
            $combinations[] = 'client_id';
        }

        if ($status != null) {
            $combinations[] = 'status';
        }

        foreach ($combinations as $combination) {
            $rents = $rents->orWhereNotNull($combination);
        }

        // Filtro adicional para alquileres no devueltos
        $rents = $rents->where('status', '!=', 'returned');
        $rents = $rents->get();

        return view('rents.index', compact('rents', 'products', 'clients', 'categories'));
    }


}