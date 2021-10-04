<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        if(isset($presence->status)){
            if ($presence->status=='hadir'||$presence->status=='izin'||$presence->status=='sakit') {
                $button = "Selamat Beristirahat";
                $type = "info";
                $status = "selesai melakukan seluruh presensi";
            }
        }elseif (!Presensi::isArrival()) {
            $button = "catat hadir";
            $type = "success";
            $status = "belum catat hadir";
        }elseif (!Presensi::isReturn()) {
            $button = "catat pulang";
            $type = "warning";
            $status = "belum catat pulang";
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
        $date = explode('|',Carbon::now()->format('Y-m-d|H:i:s'));
        if (!Presensi::isArrival()) {
            Presensi::create([
                'pegawai_id'=>auth()->user()->pegawai->id,
                'tanggal'=>$date[0],
                'jam_datang'=>$date[1]
            ]);
            return redirect()->route('presensi.index')->with('success','Berhasil melakukan presensi');
        }else{
            Presensi::findOrFail($request->presensi_id)->update([
                'tanggal'=>$date[0],
                'jam_pulang'=>$date[1],
                'status'=>'hadir'
            ]);
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

    public function allEmployee()
    {
        $date = Carbon::now()->format('Y-m');
        $date2 = explode('-',$date);
        $day = cal_days_in_month(CAL_GREGORIAN,$date2[1],$date2[0]);
        $presences = Presensi::with('pegawai:id,nama')
        ->whereYear('tanggal',$date2[0])
        ->whereMonth('tanggal',$date2[1])
        ->get()
        ->groupBy('pegawai.nama');
        // $presences = Presensi::with('pegawai')->where('pegawai_id',$id)->paginate();
        return view('admin.all_employee_presence',compact('date','day','presences'));
    }

    public function allEmployeeFilter(Request $request)
    {
        $date = explode('-',$request->month);
        $day = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
        $presences = Presensi::with('pegawai:id,nama')->whereMonth('tanggal',$date[1])->get()->groupBy('pegawai.nama');
        $date = Carbon::parse($request->month)->format('F Y');
        return view('admin.print_all_presence',compact('day','presences','date'));
    }

    public function permit(Request $request)
    {
        if ($presence = Presensi::where('pegawai_id',auth()->user()->pegawai->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))
        ->first()) {
            $presence->update(['status'=>"izin"]);
        }else {
            Presensi::create([
                'pegawai_id'=>auth()->user()->pegawai->id,
                'tanggal'=>Carbon::now()->format('Y-m-d'),
                'status'=>"izin"
            ]);
        }
        return redirect()->route('presensi.index')->with('success','Berhasil melakukan izin');
    }
}
