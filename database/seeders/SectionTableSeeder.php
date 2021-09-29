<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array('Golongan I','Golongan II','Golongan III');
        foreach ($data as $value) {
            Golongan::create(['nama'=>$value]);
        }
    }
}
