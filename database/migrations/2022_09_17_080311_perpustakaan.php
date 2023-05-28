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
        Schema::create('perpustakaans', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('judul')->unique();
            $table->string('pengarang');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->text('sinopsis');
            $table->string('cover_buku');
            $table->string('file_buku');
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
        Schema::dropIfExists('perpustakaans');
    }
};
