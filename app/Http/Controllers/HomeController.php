<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

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
        if (auth()->user()->user_type == "admin") {
            //$schools = School::withCount(['students','students as without_ijazah'=>function($q){$q->whereNull('ijazah');}])->paginate(5);
            $pnsCount = Employee::where('employee_status','pns')->count();
            $honorerCount = Employee::where('employee_status','honorer')->count();
            $employeeCount = Employee::count();
            $presences = Presence::with('employee')->orderBy('date','desc')->paginate();
            return view('dashboard_admin',compact('pnsCount','honorerCount','employeeCount','presences'));
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

    public function employeePresence($id)
    {
        $date = Carbon::now()->format('Y-m');
        $employee = Employee::find($id)->only('id','name');
        $presences = Presence::with('employee')->where('employee_id',$id)->paginate();
        return view('admin.employee_presence',compact('presences','employee','date'));
    }

    public function printPresence(Request $request)
    {
        $employee = Employee::find($request->employee_id)->only('id','name','nip');
        $date = explode('-',$request->month);
        $presences = Presence::with('employee')->where('employee_id',$request->employee_id)->whereYear('date',$date[0])->whereMonth('date',str_replace('0','',$date[1]))->get();
        return view('admin.print_presence',compact('presences','employee'));
    }

    public function mergeQueryPaginate(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Pagination\LengthAwarePaginator
    {
        $raw_query = $query;
        $totalCount = $raw_query->get()->count();

        $perPage = request('per-page', 10);
        $page = request('page', 1);
        $skip = $perPage * ($page - 1);
        $raw_query = $raw_query->take($perPage)->skip($skip);

        $parameters = request()->getQueryString();
        $parameters = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/', '', $parameters);
        $path = url(request()->getPathInfo() . '?' . $parameters);

        $rows = $raw_query->get();

        $paginator = new LengthAwarePaginator($rows, $totalCount, $perPage, $page);
        $paginator = $paginator->withPath($path);
        return $paginator;
    }
}
