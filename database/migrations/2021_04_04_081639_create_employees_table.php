<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("nip");
            $table->string("name");
            $table->string("birth_place");
            $table->date("birth_date");
            $table->enum("gender",["Laki-laki","Perempuan"]);
            $table->enum("employee_status",["pns","honorer"]);
            $table->enum("marital_status",["menikah","belum menikah"]);
            $table->enum("blood_type",['A','B','AB','O']);
            $table->text("address");
            $table->string("religion");
            $table->string("entry_year");
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger('job_title_id')->unsigned();
            $table->foreign('job_title_id')->references('id')->on('job_titles')->onDelete('cascade');
            $table->text('photo')->default("default.jpg");
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropForeign(['job_title_id']);
        });
        Schema::dropIfExists('employees');
    }
}
