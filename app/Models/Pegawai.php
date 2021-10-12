<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $fillable = [
        'nip',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'status_pegawai',
        'status_pernikahan',
        'alamat',
        'agama',
        'pendidikan',
        'jurusan',
        'tahun_masuk',
        'golongan_id',
        'jabatan_id',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }

    public function attendanceToday()
    {
        return $this->hasOne(Presensi::class)->where("presensi.tanggal",Carbon::now()->format('Y-m-d'));
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }


    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = date('Y-m-d', strtotime($value));
    }

    public function scopeSearch($query,$value)
    {
        return $query->where('nip','like','%'.$value.'%')
                ->orWhere('nama','like','%'.$value.'%');
    }

    public function scopeDashboardSearch($querry,$request)
    {
        return $querry->where('nip','like','%'.$request['nip'].'%');
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }
    }
}
