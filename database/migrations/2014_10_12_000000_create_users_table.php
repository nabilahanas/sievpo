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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nama_user');
        //     $table->string('nip');
        //     $table->string('role');
        //     $table->string('password');
        //     $table->integer('id_jabatan');
        //     $table->integer('id_wilayah');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });

        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user', 50);
            $table->string('nip', 20);
            $table->string('email')->unique();
            // $table->text('role');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_wilayah');
            $table->unsignedBigInteger('id_role');
            $table->string('password', 255);
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
            $table->foreign('id_wilayah')->references('id_wilayah')->on('wilayah')->onDelete('cascade');
            $table->foreign('id_role')->references('id_role')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
