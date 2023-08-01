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
        Schema::create('kerohanians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->date('tanggal');
            $table->integer('durasi');
            $table->string('agama');
            $table->foreignId('data_kerohanian_id');
            $table->text('laporan_kegiatan');
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
        Schema::dropIfExists('kerohanians');
    }
};
