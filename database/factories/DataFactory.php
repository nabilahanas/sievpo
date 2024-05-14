<?php

namespace Database\Factories;

use App\Models\Data;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;

class DataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Data::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Mendapatkan waktu acak
        $user = User::inRandomOrder()->first();
        $bidang = Bidang::inRandomOrder()->first();
        $tglWaktu = $this->faker->dateTimeBetween('2024-05-01', '2024-05-02');
        $jam = $tglWaktu->format('H:i:s'); // Ambil hanya jam
    
        // Temukan shift yang sesuai dengan jam yang diberikan
        $shift = Shift::whereTime('jam_mulai', '<=', $jam)
                      ->whereTime('jam_akhir', '>=', $jam)
                      ->first();
    
        // Jika shift ditemukan, ambil ID shift-nya. Jika tidak, berikan nilai default.
        $idShift = $shift ? $shift->id_shift : null;
        $approvedStatus = 'pending';
    
        return [
            'id_user' => $user->id_user,
            'id_bidang' => $bidang->id_bidang,
            'id_shift' => $idShift,
            'lokasi' => $this->faker->address,
            'created_at' => $tglWaktu,
            'foto' => $this->faker->imageUrl(),
            'is_approved' => $approvedStatus,
        ];
    }
}
