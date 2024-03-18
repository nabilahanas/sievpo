<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Bidang;
use App\Models\Shift;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $bidang = Bidang::all();
        $shift = Shift::all();

        Schema::table('data', function (Blueprint $table) use ($bidang, $shift) {
            foreach ($bidang as $bidang) {
                foreach ($shift as $s) {
                    $table->integer("poin_{$bidang->id_bidang}_{$s->id_shift}")->default(0);
                }}
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            //
        });
    }
};
