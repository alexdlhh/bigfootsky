<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the products
     * it can be filtered by category,status, size or quality in all the combinations
     * @param int category
     * @param int status
     * @param int size
     * @param int quality
     * @return \Illuminate\View\View
     */
    public function index($category = null, $status = null, $size = null, $quality = null){
        $products = Product::all();

        $products_aux = [];

        $category= ($category != 0)?$category:null;
        $status= ($status != 0)?$status:null;
        $size= !empty($size)?$size:null;
        $quality= !empty($quality)?$quality:null;

        foreach($products as $product){
            $find = true;
            if($category != null){
                if($product->category_id == $category){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($status != null){
                if($product->status == $status){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($size != null){
                if($product->size == $size){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($quality != null){
                if($product->quality == $quality){
                    //$find = true;
                }else{
                    $find = false;
                }
            }
            if($find){
                $products_aux[] = $product;
            }
        }

        $products = $products_aux;

        $categories = Category::all();
        $admin['section'] = 'products';

        $sizes = Product::select('size')->distinct()->get();
        $qualities = Product::select('quality')->distinct()->get();
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
        return view('admin.listProducts', compact('products', 'categories', 'admin', 'sizes', 'qualities', 'category', 'status', 'size', 'quality', 'healties', 'statuses'));
    }

    /**
     * view to create or edit a product
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = 0){
        $product = Product::find($id);
        $categories = Category::all();
        $admin['section'] = 'products';
        $sizes = Product::select('size')->distinct()->get();
        $qualities = Product::select('quality')->distinct()->get();
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
        return view('admin.editProduct', compact('product', 'categories', 'admin', 'id', 'sizes', 'qualities', 'healties', 'statuses'));
    }

    /**
     * this function will save the product
     * @param Request $request
     * @return Response $response
     */
    public function save(Request $request){
        try{
            $product = Product::find($request->id);
            $makeQr=false;
            if($product == null){
                $makeQr=true;
                $product = new Product();
            }
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->size = $request->size;
            $product->quality = $request->quality;
            $product->health = $request->health;
            $product->status = $request->status;
            $product->save();
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'size' => $product->size
            ];
            if($makeQr){
                $qr = QrCode::size(500)->generate(json_encode($data));
                //guardar contenido de qr en un svg
                $file = fopen(public_path().'/img/qr/'.$product->id.'.svg', 'w');
                fwrite($file, $qr);
                fclose($file);
            }
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar el producto: '.$e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Producto guardado correctamente', 'id' => $product->id]);
    }

    /**
     * this function will delete a product
     * @param int id
     * @return Response $response
     */
    public function delete(Request $request){
        try{
            $product = Product::find($request->id);
            $product->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el producto: '.$e->getMessage()]);
        }
        return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente']);
    }

    /**
     * this function will change the status of a product
     * @param int id
     * @return Response $response
     */
    public function changeStatus($id){
        try{
            $product = Product::find($id);
            if($product->status == 1){
                $product->status = 0;
            }else{
                $product->status = 1;
            }
            $product->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al cambiar el estado del producto']);
        }
        return response()->json(['success' => true, 'message' => 'Estado del producto cambiado correctamente']);
    }

}