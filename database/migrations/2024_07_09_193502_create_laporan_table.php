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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->string('status');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('file');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
            $table->unsignedBigInteger('tugas_id');
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('laporan');
    }
};
