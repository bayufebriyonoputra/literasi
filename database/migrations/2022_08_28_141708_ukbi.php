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
        Schema::create('ukbis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->date('tanggal_tes');
            $table->integer('skor');
            $table->string('sertifikat');
            $table->string('tahun_pelajran', 10);
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
        Schema::dropIfExists('ukbis');
    }
};
