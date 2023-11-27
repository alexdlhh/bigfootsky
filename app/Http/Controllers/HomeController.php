<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Muestra la vista de login
     * @return \Illuminate\View\View
     */
    public function login(){
        // Si el usuario está autenticado, redirige a la vista principal del panel
        if (Auth::check()) {
            dd(Auth::User());
            return redirect()->route('panel');
        }

        // Si el usuario no está autenticado, muestra la vista de login
        return view('auth.login');
    }

    /**
     * Autentica al usuario
     * @param Request $request
     * @return Response $response
     */
    public function do_login(Request $request){
        // Valida los datos del formulario de login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Redirige al usuario a la vista principal del panel
            return response()->json(['success' => Auth::User()->role], 200);
        }

        // Si la autenticación falla, muestra un error
        return response()->json(['error' => 'Los datos ingresados son incorrectos.'], 401);
    }

    /**
     * Cierra la sesión del usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        // Cierra la sesión del usuario
        Auth::logout();

        // Redirige al usuario a la vista de login
        return redirect()->route('login');
    }

    /**
     * Muestra la vista de registro
     * @return \Illuminate\View\View
     */
    public function register(){
        // Muestra la vista de registro
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario
     * @param Request $request
     * @return String $role
     */
    public function do_register(Request $request){
        // Valida los datos del formulario de registro
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        // Crea un nuevo usuario
        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->role = $request->role;
        $user->save();

        // Inicia sesión con el usuario recién creado
        Auth::login($user);

        // Redirige al usuario a la vista principal del panel
        return $user->role;
    }

    /**
     * Muestra la vista principal del panel Admin
     * @return \Illuminate\View\View
     */
    public function adminPanel(){
        $admin['section'] = 'adminPanel';
        return view('admin.adminPanel',['admin' => $admin]);
    }

    public function reserva(){
        $admin['section'] = 'reserva';
        return view('front.reserva',['admin' => $admin]);
    }

    public function step2(){
        $admin['section'] = 'step2';
        return view('front.step2',['admin' => $admin]);
    }

    public function thanks(){
        $admin['section'] = 'thanks';
        return view('front.thanks',['admin' => $admin]);
    }

    public function syncRent($id){
        $admin['section'] = 'syncRent';
        $rents = file_get_contents('https://erp.nomadspro.com/bigfootski/get/'.$id);
        $products = [];
        foreach(json_decode($rents, true)['data'] as $rent){
            $products[] = Product::find($rent['id_product']);
        }
        return response()->json($products, 200);
    }

    public function firma($id){
        $client = Client::find($id);
        $admin['section'] = 'firma';
        return view('front.firma',['admin' => $admin, 'client' => $client]);
    }

    public function saveFirma(Request $request){
        try{
            $firma = $request->firma;
            //subimos la imagen a la carpeta public
            $image_parts = explode(";base64,", $firma);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $firma = uniqid() . '.png';
            $file = public_path() . "/firma/" . $firma;
            file_put_contents($file, $image_base64);
            //guardamos la imagen en la bbdd

            $client = Client::find($request->id);
            $client->firma = $file;
            $client->save();
        }catch(\Exception $e){
            return response()->json(["success"=>false,'error' => $e->getMessage()], 500);
        }
    }
}
