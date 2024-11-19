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
        Schema::table('unggah_karya', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('karya_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unggah_karya', function (Blueprint $table) {
            $table->dropIfExists('tanggal');
        });
    }
};
