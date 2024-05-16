<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id('id_data');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_bidang');
            $table->unsignedBigInteger('id_shift');
            $table->text('lokasi');
            $table->timestamp('tgl_waktu');
            $table->text('foto');
            $table->enum('is_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('poin')->default(0);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_bidang')->references('id_bidang')->on('bidang')->onDelete('cascade');
            $table->foreign('id_shift')->references('id_shift')->on('shift')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
