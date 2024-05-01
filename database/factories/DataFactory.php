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
        // Ambil satu entitas user, bidang, dan shift secara acak
        $user = User::inRandomOrder()->first();
        $bidang = Bidang::inRandomOrder()->first();
        $shift = Shift::inRandomOrder()->first();

        // Variasi nilai untuk is_approved
        $approvedStatus = 'approved';

        return [
            'id_user' => $user->id_user,
            'id_bidang' => $bidang->id_bidang,
            'id_shift' => $shift->id_shift,
            'lokasi' => $this->faker->address,
            'tgl_waktu' => $this->faker->dateTimeBetween('2024-03-01', '2024-03-31'),
            'foto' => $this->faker->imageUrl(),
            'is_approved' => $approvedStatus,
            'poin' => $shift->poin,
            'created_at' => $this->faker->dateTimeBetween('2024-05-01', '2024-05-01'),
        ];
    }
}
