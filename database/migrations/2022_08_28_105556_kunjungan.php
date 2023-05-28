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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id');
            $table->foreignId('siswa_id');
            $table->date('tanggal');
            $table->string('nama_tempat')->nullable();
            $table->string('profil_pelajar_pancasila');
            $table->text('keterangan');
            $table->text('hasil_kunjungan');
            $table->string('file_foto');
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
        Schema::dropIfExists('kunjungans');
    }
};
