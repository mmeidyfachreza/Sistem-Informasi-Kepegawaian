<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        dd($this);
        $employeeStatus = $this->faker->randomElement(array("pns","honorer"));
        return [
            'nip' => $this->faker->numerify('################'),
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'jenis_kelamin' => $this->faker->randomElement(array("Laki-laki","Perempuan")),
            'status_pegawai' => $employeeStatus,
            'status_pernikahan' => $this->faker->randomElement(array("menikah","belum menikah")),
            'golongan_darah' => $this->faker->randomElement(array('A','B',"AB",'o')),
            'alamat' => $this->faker->address,
            'agama' => "Islam",
            'pendidikan' => 'S1',
            'jurusan' => 'Teknik',
            'tahun_masuk' => $this->faker->year(),
            'jabatan_id' => $this->faker->randomElement(array(1,2,3)),
        ];
    }
}
