<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JobTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array('Pimpinan','Staff','IT');
        foreach ($data as $value) {
            Jabatan::create(['nama'=>$value]);
        }
    }
}
