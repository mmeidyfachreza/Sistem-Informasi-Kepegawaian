<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];

    public function karyawan()
    {
        $this->hasMany(Karyawan::class);
    }
}
