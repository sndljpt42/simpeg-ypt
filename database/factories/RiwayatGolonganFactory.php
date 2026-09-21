<?php

namespace Database\Factories;

use App\Models\RiwayatGolongan;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiwayatGolonganFactory extends Factory
{
    /**
     * Model yang digunakan oleh factory ini.
     */
    protected $model = RiwayatGolongan::class;

    /**
     * Data default untuk kebutuhan testing.
     */
    public function definition(): array
    {
        return [
            // ID pegawai akan diberikan saat Factory digunakan.
            // Kita tidak membuat ID secara acak karena harus
            // benar-benar menunjuk ke pegawai yang ada.
            'pegawai_id' => null,

            // ID golongan juga diberikan saat Factory digunakan.
            // Nilainya harus berasal dari master golongan.
            'golongan_id' => null,

            // Nomor SK dibuat otomatis untuk kebutuhan testing.
            'nomor_sk' => 'SK/TEST/' . fake()->unique()->numerify('#####'),

            // Tanggal SK untuk data testing.
            'tanggal_sk' => fake()->date(),

            // TMT dibuat sebagai tanggal tersendiri karena
            // tanggal SK dan TMT adalah dua informasi berbeda.
            'tmt' => fake()->date(),

            // Keterangan tidak wajib diisi.
            'keterangan' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Menentukan pegawai yang memiliki riwayat ini.
     */
    public function forPegawai(int $pegawaiId): static
    {
        return $this->state(fn(array $attributes) => [
            // Gunakan ID pegawai yang diberikan oleh test.
            'pegawai_id' => $pegawaiId,
        ]);
    }

    /**
     * Menentukan golongan yang tercantum pada riwayat ini.
     */
    public function forGolongan(int $golonganId): static
    {
        return $this->state(fn(array $attributes) => [
            // Gunakan ID golongan dari master Golongan.
            'golongan_id' => $golonganId,
        ]);
    }
}
