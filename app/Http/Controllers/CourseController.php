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
use App\Models\CourseList;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * this function will load the view of the courses
     * it can be filtered by name, teacher, date or time
     * @param String name
     * @param int teacher
     * @param String date
     * @param String time
     * @return \Illuminate\View\View
     */
    public function index($name = null, $teacher = null, $date = null, $time = null)
    {
        $query = Course::query();

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
        $courses = $query->get();
        $admin['section'] = 'courses';
        return view('admin.listCourse', compact('courses', 'admin'));
    }

    /**
     * this function will load the view of the courses
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $course = null;
        $products = Product::where('status', 1)->get();
        if($id != null){
            $course = Course::find($id);
            $apuntados = CourseList::where('id_course', $id)->get();
            $apuntados_list = [];
            $productByClient = [];
            foreach($apuntados as $apuntado){
                $apuntados_list[] = $apuntado->id_client;
                $productByClient[$apuntado->id_client] = $apuntado->product;
            }
           
            $clients = Client::whereNotIn('id', $apuntados_list)->get();
            $students = Client::whereIn('id', $apuntados_list)->get();
            $students_products = [];
            foreach($students as $student){
                $students_products[$student->id] = Product::where('id', $productByClient[$student->id])->first();
            }
        }else{
            $clients = Client::all();
            $students = [];
        }
        $teachers = Teacher::all();
        $admin['section'] = 'courses';
        return view('admin.editCourse', compact('course', 'admin', 'teachers', 'clients', 'students', 'products', 'students_products'));
    }

    /**
     * this function will save the course
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function save(Request $request){
        try{
            $course = null;
            if($request->id != 0){
                $course = Course::find($request->id);
            }else{
                $course = new Course();
            }
            $course->name = $request->name;
            $course->description = $request->description;
            $course->status = $request->status;
            $course->max_students = $request->max_students;
            $course->date = $request->date;
            $course->time_start = $request->time_start;
            $course->time_end = $request->time_end;
            $course->teacher_id = $request->teacher_id;
            $course->material = $request->material;
            $course->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al guardar el curso']);
        }
        return response()->json(['success' => true, 'message' => 'Curso guardado correctamente', 'id' => $course->id]);
    }

    /**
     * this function will delete the curso
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function delete(Request $request){
        try{
            $course = Course::find($request->id);
            $course->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el curso']);
        }
        return response()->json(['success' => true, 'message' => 'Curso eliminado correctamente']);
    }

    /**
     * add a student to a course
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function addStudent(Request $request){
        try{
            if(!empty($request->id)){
                $courseList = CourseList::find($request->id);
            }else{
                $courseList = new CourseList();
            }
            $id_course = $request->id_course;
            $id_student = $request->id_student;
            $product = $request->product ?? 0;            
            $courseList->id_course = $id_course;
            $courseList->id_client = $id_student;
            $courseList->product = $product;
            $courseList->save();

        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al añadir el alumno al curso']);
        }
        return response()->json(['success' => true, 'message' => 'Alumno añadido correctamente']);
    }

    /**
     * delete a student from a course
     * @param Request request
     * @return \Illuminate\Ressponse\JsonResponse
     */
    public function deleteStudent(Request $request){
        try{
            $courseList = CourseList::find($request->id);
            $courseList->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el alumno del curso']);
        }
        return response()->json(['success' => true, 'message' => 'Alumno eliminado correctamente']);
    }
}
