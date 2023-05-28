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
        Schema::create('warga_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignid('kelas_id');
            $table->foreignId('siswa_id');
            $table->foreignId('wali_kelas_id');
            $table->string('tahun_pelajaran', 14);
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
        Schema::dropIfExists('warga_kelas');
    }
};
