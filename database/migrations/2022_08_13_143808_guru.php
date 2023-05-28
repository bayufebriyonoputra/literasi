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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('password');
            $table->string('nama');
            $table->text('alamat');
            $table->char('jenis_kelamin');
            $table->boolean('admin')->default(false);
            $table->boolean('walas')->default(false);
            $table->boolean('inovasi')->default(false);
            $table->boolean('perpustakaan')->default(false);
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
        Schema::dropIfExists('gurus');
    }
};
