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
        Schema::create('ekstensif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->date('tanggal');
            $table->integer('durasi');
            $table->string('isbn');
            $table->string('judul_buku');
            $table->string('jumlah_halaman')->nullable();
            $table->text('rangkuman');
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
        Schema::dropIfExists('ekstensif');
    }
};
