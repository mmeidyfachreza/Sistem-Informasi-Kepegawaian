<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presence = Presence::where('employee_id',auth()->user()->employee->id)
        ->where('date',now()->toDateString('Y-m-d'))->first();
        if (!Presence::isArrival()) {
            $button = "catat hadir";
            $type = "success";
            $status = "belum catat hadir";
        }elseif (!Presence::isReturn()) {
            $button = "catat pulang";
            $type = "warning";
            $status = "belum catat pulang";
        }else{
            $button = "Selamat Beristirahat";
            $type = "info";
            $status = "selesai melakukan seluruh presensi";
        }
        $presences = Presence::where('employee_id',auth()->user()->employee->id)->orderBy('date','desc')->paginate();
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
        if ($request->input('arrival_time')) {
            Presence::create(array_merge($request->all(),['employee_id'=>auth()->user()->employee->id]));
            return redirect()->route('presensi.index')->with('success','Berhasil melakukan presensi');
        }else{
            Presence::findOrFail($request->presence_id)->update($request->all());
            return redirect()->route('presensi.index')->with('success','Berhasil melakukan presensi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
