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


class ParticularController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the Particulars
     * it can be filtered by name, teacher, date or time
     * @param String name
     * @param int teacher
     * @param String date
     * @param String time
     * @return \Illuminate\View\View
     */
    public function index($name = null, $teacher = null, $date = null, $time = null)
    {
        $query = Particular::query();

        if($name !== null){
            $query->where('name', 'like', '%'.$name.'%');
        }

        if($teacher !== null){
            $query->where('teacher', 'like', '%'.$teacher.'%');
        }

        if($date !== null){
            $query->where('date', 'like', '%'.$date.'%');
        }

        if($time !== null){
            $query->where('time', 'like', '%'.$time.'%');
        }
        $particulars = $query->get();
        $admin['section'] = 'particulars';
        return view('admin.listParticular', compact('particulars', 'admin'));
    }

    /**
     * this function will load the view of the Particulars
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $particular = null;
        if($id != null){
            $particular = Particular::find($id);
        }
        $teachers = Teacher::all();
        $admin['section'] = 'particulars';
        return view('admin.editParticular', compact('particular', 'admin', 'teachers'));
    }

    /**
     * this function will save the Particular
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $particular = null;
            if($request->id != 0){
                $particular = Particular::find($request->id);
            }else{
                $particular = new Particular();
            }
            $particular->name = $request->name;
            $particular->description = $request->description;
            $particular->status = $request->status;
            $particular->max_students = $request->max_students;
            $particular->date = $request->date;
            $particular->time_start = $request->time_start;
            $particular->time_end = $request->time_end;
            $particular->teacher_id = $request->teacher_id;
            $particular->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar la clase particular']);
        }
        return response()->json(['success' => true, 'message' => 'Teacher guardado correctamente', 'id' => $particular->id]);
    }

    /**
     * this function will delete the particuilar
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $particular = Particular::find($request->id);
            $particular->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar la clase particular']);
        }
        return response()->json(['success' => true, 'message' => 'Teacher eliminado correctamente']);
    }

}
