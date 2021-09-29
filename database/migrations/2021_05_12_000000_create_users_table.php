<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->string('username',30)->unique();
            $table->string('password');
            $table->enum("tipe_user",['staff','admin']);
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pegawai_id']);
        });
        Schema::dropIfExists('users');
    }
}
