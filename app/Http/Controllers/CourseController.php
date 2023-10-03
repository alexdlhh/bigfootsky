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
        $teachers = $query->get();
        $admin['section'] = 'courses';
        return view('admin.listCourse', compact('teachers', 'admin'));
    }

    /**
     * this function will load the view of the courses
     * @param int id
     * @return \Illuminate\View\View
     */
    public function create($id = null){
        $course = null;
        if($id != null){
            $course = Course::find($id);
        }
        $admin['section'] = 'courses';
        return view('admin.editCourse', compact('course', 'admin'));
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
            $course->save();
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
            $course = Course::find($request->id);
            $course->delete();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Error al eliminar el teacher']);
        }
        return response()->json(['success' => true, 'message' => 'Teacher eliminado correctamente']);
    }
}
