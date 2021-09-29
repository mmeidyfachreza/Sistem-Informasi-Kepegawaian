<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolongaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Golongan::paginate();
        return view('admin.section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Golongan::create($request->all());
        return redirect()->route('golongan.index')->with('success','Berhasil menambah data');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Golongan  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Golongan::findOrFail($id);
        return view('admin.section.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Golongan  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Golongan::findOrFail($id)->update($request->all());
        return redirect()->route('golongan.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Golongan  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Golongan::findOrFail($id)->delete();
        return redirect()->route('golongan.index')->with('success','Berhasil menghapus data');
    }
}
