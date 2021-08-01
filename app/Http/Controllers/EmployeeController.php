<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('jobTitle')->paginate();
        return view('admin.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah";
        $genders = array('Laki-laki','Perempuan');
        $status = array('pns','honorer');
        $maritals = array("menikah","belum menikah");
        $user_types = array("staff","admin");
        $religions = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu');
        $educations = array('SD', 'SMA', 'SMK', 'D3', 'S1/D4', 'S2', 'S3');
        $jobTitles = JobTitle::all();
        $sections = Section::all();
        return view('admin.employee.create',compact('page','genders','status','maritals','religions','jobTitles','user_types','sections','educations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::create($request->all());
            if ($avatars = $request->file('photo')) {
                $name = time().'.'.$avatars->getClientOriginalExtension();
                $employee->photo = $name;
                $photo = $request->photo->storeAs('public/photos',$name);
                $employee->save();
            }
            User::create([
                'employee_id' => $employee->id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
                'remember_token' => Str::random(10),
            ]);
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pegawai.create')->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('pegawai.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "Detail";
        $employee = Employee::with('jobTitle','section')->findOrFail($id);
        return view('admin.employee.show',compact('employee','page'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Ubah";
        $genders = array('Laki-laki','Perempuan');
        $status = array('pns','honorer');
        $maritals = array("menikah","belum menikah");
        $user_types = array("staff","admin");
        $religions = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu');
        $educations = array('SD', 'SMA', 'SMK', 'D3', 'S1/D4', 'S2', 'S3');
        $jobTitles = JobTitle::all();
        $sections = Section::all();
        $employee = Employee::with('jobTitle','section')->find($id);
        return view('admin.employee.edit',compact('page','genders','status','maritals','religions','jobTitles','user_types','employee','sections','educations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($id);
            if ($photo = $request->file('photo')) {
                Storage::delete('photo/'.$employee->photo);
                $name = $request->name.'-'.time().'.'.$photo->getClientOriginalExtension();
                $request->request->add(['photo' => $name]);
                $request->photo->storeAs('public/photos',$name);
            }
            $employee->update($request->all());
            $user = User::findOrFail($employee->user->id);
            $user->username = $request->username;
            $user->user_type = $request->user_type;
            if($request->input('password')){
                $user->password = Hash::make($request->password);
            }
            $user->update();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pegawai.edit',$id)->withErrors(['message'=>$e->getMessage()]);
        }

        return redirect()->route('pegawai.index')->with('success','Berhasil menambah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (auth()->user()->id == $employee->id) {
            return redirect()->route('pegawai.index')->withErrors(['message'=>'Tidak dapat menghapus akun yang sedang login']);
        }
        Storage::delete('photos/'.$employee->photo);
        $employee->delete();
        return redirect()->route('pegawai.index')->with('success','Berhasil menghapus data');
    }

    public function searchByNIP(Request $request)
    {
        $page = "Dashboard";
        $employee = Employee::searchByNIP($request->nip)->first();
        return view('dashboard',compact('employee','page'));
    }

    public function searchEmployee(Request $request)
    {
        $page = 'Siswa '.strtoupper($request->level);
        $employees = Employee::with('jobTitle')->filterBy($request->all())->paginate();

        return view('admin.employee.index',compact('page','employees','request'));
    }
}
