<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
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
        if (auth()->user()->tipe_user == "admin") {
            $pnsCount = Pegawai::where('status_pegawai','pns')->count();
            $honorerCount = Pegawai::where('status_pegawai','honorer')->count();
            $employeeCount = Pegawai::count();
            $presences = Presensi::with('pegawai')->orderBy('tanggal','desc')->paginate();
            return view('dashboard_admin',compact('pnsCount','honorerCount','employeeCount','presences'));
        }else{
            return view('dashboard');
        }

    }

    public function searchPegawai(Request $request)
    {
        if (auth()->user()->tipe_user == "admin") {
            $pnsCount = Pegawai::where('status_pegawai','pns')->count();
            $honorerCount = Pegawai::where('status_pegawai','honorer')->count();
            $employeeCount = Pegawai::count();
            $employee = Pegawai::with('jabatan')->dashboardSearch($request->all())->first();
            $presences = Presensi::with('pegawai')->orderBy('tanggal','desc')->paginate();
            return view('dashboard_admin',compact('pnsCount','honorerCount','employeeCount','employee','presences'));
        }else{
            //
        }
    }

    public function employeePresence($id)
    {
        $date = Carbon::now()->format('Y-m');
        $employee = Pegawai::find($id)->only('id','nama');
        $presences = Presensi::with('pegawai')->where('pegawai_id',$id)->paginate();
        return view('admin.employee_presence',compact('presences','employee','date'));
    }

    public function printPresence(Request $request)
    {
        $employee = Pegawai::find($request->pegawai_id)->only('id','nama','nip');
        $date = explode('-',$request->month);
        $presences = Presensi::with('pegawai')->where('pegawai_id',$request->pegawai_id)->whereYear('tanggal',$date[0])->whereMonth('tanggal',str_replace('0','',$date[1]))->get();
        return view('admin.print_presence',compact('presences','employee','request'));
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

    public function profile()
    {
        $page = "Profil";
        $employee = Pegawai::with('jabatan','golongan')->findOrFail(auth()->user()->pegawai->id);
        return view('admin.employee.show',compact('employee','page'));
    }
}
