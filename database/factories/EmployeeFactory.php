<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
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
        $employeeStatus = $this->faker->randomElement("pns","honorer");
        return [
            'nip' => $this->faker->randomNumber(),
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'jenis_kelamin' => $this->faker->randomElement("Laki-laki","Perempuan"),
            'status_pegawai' => $employeeStatus,
            'status_pernikahan' => $this->faker->randomElement("menikah","belum menikah"),
            'golongan_darah' => $this->faker->randomElement('A','B',"AB",'o'),
            'alamat' => $this->faker->address,
            'agama' => "Islam",
            'pendidikan' => 'S1',
            'jurusan' => 'Teknik',
            'tahun_masuk' => $this->faker->year(),
            'jabatan_id' => $this->faker->randomElement(1,2,3),
        ];
    }
}
