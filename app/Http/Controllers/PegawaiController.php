<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Pegawai::with('jabatan')->paginate();
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
        $jobTitles = Jabatan::all();
        $sections = Golongan::all();
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
            $employee = Pegawai::create($request->all());
            if ($avatars = $request->file('foto')) {
                $name = $request->nip.'-'.time().'.'.$avatars->getClientOriginalExtension();
                $employee->foto = $name;
                $foto = $request->foto->storeAs('public/foto',$name);
                $employee->save();
            }
            User::create([
                'pegawai_id' => $employee->id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'tipe_user' => $request->tipe_user,
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
     * @param  \App\Models\Pegawai  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "Detail";
        $employee = Pegawai::with('jabatan','golongan')->findOrFail($id);
        return view('admin.employee.show',compact('employee','page'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $employee
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
        $educations = array('SD', 'SMA', 'SMK', 'D3', 'D4', 'S1', 'S2', 'S3');
        $jobTitles = Jabatan::all();
        $sections = Golongan::all();
        $employee = Pegawai::with('jabatan','golongan')->find($id);
        return view('admin.employee.edit',compact('page','genders','status','maritals','religions','jobTitles','user_types','employee','sections','educations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employee = Pegawai::findOrFail($id);
            if ($foto = $request->file('foto')) {
                Storage::delete('foto/'.$employee->foto);
                $name = $request->nip.'-'.time().'.'.$foto->getClientOriginalExtension();
                $employee->foto = $name;
                $request->foto->storeAs('public/foto',$name);
            }
            $employee->update($request->all());
            $user = User::findOrFail($employee->user->id);
            $user->username = $request->username;
            $user->tipe_user = $request->tipe_user;
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
     * @param  \App\Models\Pegawai  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Pegawai::find($id);
        if (auth()->user()->id == $employee->id) {
            return redirect()->route('pegawai.index')->withErrors(['message'=>'Tidak dapat menghapus akun yang sedang login']);
        }
        Storage::delete('foto/'.$employee->foto);
        $employee->delete();
        return redirect()->route('pegawai.index')->with('success','Berhasil menghapus data');
    }

    public function search(Request $request)
    {
        $page = "Pegawai";
        $employees = Pegawai::with('jabatan')->search($request->value)->paginate();
        return view('admin.employee.index',compact('page','employees','request'));
    }

    public function searchPegawai(Request $request)
    {
        $page = 'Pegawai '.strtoupper($request->level);
        $employees = Pegawai::with('jabatan')->filterBy($request->all())->paginate();

        return view('admin.employee.index',compact('page','employees','request'));
    }
}
