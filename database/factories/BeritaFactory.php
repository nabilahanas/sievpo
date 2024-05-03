<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->text(),
            'gambar' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->text(),
            'tgl_publikasi' => $this->faker->date(),
        ];
    }
}
