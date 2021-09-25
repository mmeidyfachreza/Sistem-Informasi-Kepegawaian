<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string("nip");
            $table->string("nama");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->enum("jenis_kelamin",["Laki-laki","Perempuan"]);
            $table->enum("status_pegawai",["pns","honorer"]);
            $table->enum("status_pernikahan",["menikah","belum menikah"]);
            $table->enum("golongan_darah",['A','B','AB','O']);
            $table->text("alamat");
            $table->string("agama");
            $table->string("pendidkan");
            $table->string("jurusan");
            $table->string("tahun_diterima");
            $table->bigInteger('golongan_id')->unsigned()->nullable();
            $table->foreign('golongan_id')->references('id')->on('golongans')->onDelete('cascade');
            $table->bigInteger('jabatan_id')->unsigned();
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
            $table->string('foto')->default("default.jpg");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropForeign(['karyawan_id']);
        });
        Schema::dropIfExists('karyawans');
    }
}
