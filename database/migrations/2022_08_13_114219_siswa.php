<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('tahun_masuk', 4);
            $table->string('nomor_induk');
            $table->string('password');
            $table->string('nama');
            $table->text('alamat');
            $table->char('jenis_kelamin');
            $table->string('nama_wali');
            $table->string('hp_siswa', 14);
            $table->string('hp_wali', 14);
            $table->text('tes_diagnostik');
            $table->string('tahun_pelajaran', 10);
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
};
