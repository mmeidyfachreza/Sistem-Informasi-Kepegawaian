<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTitles = Jabatan::paginate();
        return view('admin.job_title.index',compact('jobTitles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job_title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jabatan::create($request->all());
        return redirect()->route('golongan.index')->with('success','Berhasil menambah data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobTitle = Jabatan::findOrFail($id);
        return view('admin.job_title.edit',compact('jobTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Jabatan::findOrFail($id)->update($request->all());
        return redirect()->route('golongan.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jabatan::findOrFail($id)->delete();
        return redirect()->route('golongan.index')->with('success','Berhasil menghapus data');
    }
}
