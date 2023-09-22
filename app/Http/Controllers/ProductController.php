<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;


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
    public function index($category = 0, $status = 0, $size = 0, $quality = 0){
        $products = Product::where('id', '>', 0);

        // Categoría
        if ($category != 0) {
            $products = $products->where('category_id', $category);
        } else {
            $products = $products->whereNull('category_id');
        }

        // Estado
        if ($status != 0) {
            $products = $products->where('status', $status);
        } else {
            $products = $products->whereNull('status');
        }

        // Tamaño
        if ($size != 0) {
            $products = $products->where('size', $size);
        } else {
            $products = $products->whereNull('size');
        }

        // Calidad
        if ($quality != 0) {
            $products = $products->where('quality', $quality);
        } else {
            $products = $products->whereNull('quality');
        }

        // Combinaciones
        $combinations = array();

        if ($category != 0) {
            $combinations[] = 'category_id';
        }

        if ($status != 0) {
            $combinations[] = 'status';
        }

        if ($size != 0) {
            $combinations[] = 'size';
        }

        if ($quality != 0) {
            $combinations[] = 'quality';
        }

        foreach ($combinations as $combination) {
            $products = $products->orWhereNotNull($combination);
        }

        $products = $products->get();

        $categories = Category::all();
        $admin['section'] = 'products';

        $sizes = Product::select('size')->distinct()->get();
        $qualities = Product::select('quality')->distinct()->get();

        return view('admin.listProducts', compact('products', 'categories', 'admin', 'sizes', 'qualities', 'category', 'status', 'size', 'quality'));
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
        return view('admin.editProduct', compact('product', 'categories', 'admin', 'id'));
    }

    /**
     * this function will save the product
     * @param Request $request
     * @return Response $response
     */
    public function save(Request $request){
        try{
            $product = Product::find($request->id);
            if($product == null){
                $product = new Product();
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar el producto']);
        }
        return response()->json(['success' => true, 'message' => 'Producto guardado correctamente']);
    }

    /**
     * this function will delete a product
     * @param int id
     * @return Response $response
     */
    public function delete($id){
        try{
            $product = Product::find($id);
            $product->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el producto']);
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