<?php

namespace Database\Factories;

use App\Models\Golongan;
use Illuminate\Database\Eloquent\Factories\Factory;

class GolonganFactory extends Factory
{
    /**
     * Model yang digunakan oleh factory ini.
     */
    protected $model = Golongan::class;

    /**
     * Data default untuk kebutuhan testing.
     */
    public function definition(): array
    {
        return [
            // Kita gunakan nilai yang memang sesuai
            // dengan struktur master Golongan di aplikasi.
            'golongan' => 'III',

            // Ruang dibuat B sebagai contoh data testing.
            'ruang' => 'B',

            // Kode harus unik karena kolom kode
            // pada database memiliki UNIQUE constraint.
            'kode' => 'TEST/' . fake()->unique()->numerify('###'),
        ];
    }
}
