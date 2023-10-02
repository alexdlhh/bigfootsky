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


class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the teachers
     * it can be filtered by name, dni, email or phone
     * @param String name
     * @param String dni
     * @param String email
     * @param String phone
     * @return \Illuminate\View\View
     */
    public function index($name = null, $dni = null, $email = null, $phone = null)
    {
        $query = Teacher::query();

        if($name !== null){
            $query->where('name', 'like', '%'.$name.'%');
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
        $teachers = $query->get();
        $admin['section'] = 'teachers';
        return view('admin.listTeachers', compact('teachers', 'admin'));
    }

    /**
     * this function will load the view of the rent
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $teacher = null;
        if($id != null){
            $teacher = Teacher::find($id);
        }
        $admin['section'] = 'teachers';
        return view('admin.editTeacher', compact('teacher', 'admin'));
    }

    /**
     * this function will save the teacher
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $teacher = null;
            if($request->id != 0){
                $teacher = Teacher::find($request->id);
            }else{
                $teacher = new Teacher();
            }
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->dni = $request->dni;
            $teacher->langs = $request->langs;
            $teacher->type = $request->type;
            $teacher->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar el teacher']);
        }
        return response()->json(['success' => true, 'message' => 'Teacher guardado correctamente']);
    }

    /**
     * this function will delete the teacher
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $teacher = Teacher::find($request->id);
            $teacher->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el teacher']);
        }
        return response()->json(['success' => true, 'message' => 'Teacher eliminado correctamente']);
    }
}
