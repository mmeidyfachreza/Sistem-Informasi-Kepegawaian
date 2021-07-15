<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(now()->toDateString('Y-m-d'));
        if (auth()->user()->user_type == "admin") {
            //$schools = School::withCount(['students','students as without_ijazah'=>function($q){$q->whereNull('ijazah');}])->paginate(5);
            $pnsCount = Employee::where('employee_status','pns')->count();
            $honorerCount = Employee::where('employee_status','honorer')->count();
            $employeeCount = Employee::count();
            return view('dashboard_admin',compact('pnsCount','honorerCount','employeeCount'));
        }else{
            // $schoolsName = School::find(auth()->guard("web")->user()->school_id);
            // $studentCount = Student::whereHas('school',function($q){$q->where("id",auth()->guard('web')->user()->school_id);})->count();
            return view('dashboard');
        }

    }

    public function searchStudent(Request $request)
    {
        if (auth()->user()->user_type == "admin") {
            $pnsCount = Employee::where('employee_status','pns')->count();
            $honorerCount = Employee::where('employee_status','honorer')->count();
            $employeeCount = Employee::count();
            $employee = Employee::with('jobTitle')->dashboardSearch($request->all())->first();
            return view('dashboard',compact('pnsCount','honorerCount','employeeCount','employee'));
        }else{
            // $studentCount = Student::whereHas('school',function($q){$q->where("id",auth()->guard('web')->user()->school_id);})->count();
            // $schoolsName = School::find(auth()->guard("web")->user()->school_id);
            // $student = Student::with('school')->dashboardSearch($request->all())->first();
            // return view('dashboard',compact('page','studentCount','schoolsName','student'));
        }
    }
}
