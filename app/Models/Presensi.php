<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $fillable = ['pegawai_id','jam_datang','jam_pulang','tanggal','status'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function scopeIsArrival($query)
    {
        return $query->where('pegawai_id',auth()->user()->pegawai->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))
        ->whereNotNull('jam_datang')
        ->whereNull('status')
        ->exists();

    }

    public function scopeIsReturn($query)
    {
        if ($this->where('pegawai_id',auth()->user()->pegawai->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))
        ->whereNotNull('jam_pulang')
        ->whereNotIn('status',['izin','sakit','alpa'])
        ->first()) {
            return true;
        }else{
            return false;
        }
    }

    public function scopeAttendanceThisDay($query,$employee_id)
    {
        return $query->where('pegawai_id',$employee_id)
        ->where('tanggal',now()->toDateString('Y-m-d'))
        ->first();
    }
}
