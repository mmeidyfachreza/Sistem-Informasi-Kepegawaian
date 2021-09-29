<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presence = Presensi::where('pegawai_id',auth()->user()->pegawai->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))->first();
        if (!Presensi::isArrival()) {
            $button = "catat hadir";
            $type = "success";
            $status = "belum catat hadir";
        }elseif (!Presensi::isReturn()) {
            $button = "catat pulang";
            $type = "warning";
            $status = "belum catat pulang";
        }else{
            $button = "Selamat Beristirahat";
            $type = "info";
            $status = "selesai melakukan seluruh presensi";
        }
        $presences = Presensi::where('pegawai_id',auth()->user()->pegawai->id)->orderBy('tanggal','desc')->paginate();
        return view('index',compact('presences','button','type','status','presence'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('jam_datang')) {
            Presensi::create(array_merge($request->all(),['pegawai_id'=>auth()->user()->pegawai->id]));
            return redirect()->route('presensi.index')->with('success','Berhasil melakukan presensi');
        }else{
            Presensi::findOrFail($request->presensi_id)->update($request->all());
            return redirect()->route('presensi.index')->with('success','Berhasil melakukan presensi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presence)
    {
        //
    }
}
