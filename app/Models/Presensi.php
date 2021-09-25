<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $fillable = ['karyawan_id','jam_datang','jam_pulang','tanggal'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function scopeIsArrival($query)
    {
        if ($this->where('karyawan_id',auth()->user()->karyawan->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))->first()) {
            return true;
        }else{
            return false;
        }

    }

    public function scopeIsReturn($query)
    {
        if ($this->where('karyawan_id',auth()->user()->karyawan->id)
        ->where('tanggal',now()->toDateString('Y-m-d'))->whereNotNull('jam_pulang')->first()) {
            return true;
        }else{
            return false;
        }
    }
}
