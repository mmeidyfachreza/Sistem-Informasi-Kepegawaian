<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        $employee = Employee::create([
            "nip" => "12345",
            "name" => "admin",
            "birth_place" => "Samarinda",
            "birth_date" => 1997-01-01,
            "gender" => "Laki-laki",
            "employee_status" => "pns",
            "marital_status" => "menikah",
            "blood_type" => 'A',
            "address" => "Jl.Harapan Baru",
            "religion" => "Islam",
            "education" => "S1",
            "entry_year" => "2020",
            "job_title_id" => 1,
            "section_id" => 2,
        ]);

        User::create([
            'employee_id' => $employee->id,
            'username' => "admin",
            'password' => Hash::make("123123"),
            'user_type' => "admin",
            'remember_token' => Str::random(10),
        ]);
    }
}
