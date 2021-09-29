<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Pegawai::create([
            "nip" => "12345",
            "nama" => "admin",
            "tempat_lahir" => "Samarinda",
            "tanggal_lahir" => "02-05-1997",
            "jenis_kelamin" => "Laki-laki",
            "status_pegawai" => "pns",
            "status_pernikahan" => "menikah",
            "golongan_darah" => 'A',
            "alamat" => "Jl.Harapan Baru",
            "agama" => "Islam",
            "pendidikan" => "S1",
            "jurusan" => "Teknik Informatika",
            "tahun_masuk" => "2020",
            "jabatan_id" => 1,
            "golongan_id" => 2,
        ]);

        User::create([
            'pegawai_id' => $employee->id,
            'username' => "admin",
            'password' => Hash::make("123123"),
            'tipe_user' => "admin",
        ]);
    }
}
