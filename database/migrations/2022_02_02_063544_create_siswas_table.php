<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('namalengkap');
            $table->string('nis')->nullable();
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->date('alamat');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('nama_wali');
            $table->string('alamat_wali');
            $table->string('kota');
            $table->string('asal_sekolah');
            $table->string('foto');
            $table->enum('status', ['Calon', 'Siswa', 'Alumni']);
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
        Schema::dropIfExists('siswas');
    }
}
