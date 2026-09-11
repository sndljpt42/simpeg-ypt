<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJabatanAkademikRequest extends FormRequest
{
    /**
     * Menentukan apakah user diperbolehkan menjalankan request ini.
     */
    public function authorize(): bool
    {
        // Untuk saat ini request diperbolehkan.
        return true;
    }

    /**
     * Menentukan aturan validasi saat memperbarui Jabatan Akademik.
     */
    public function rules(): array
    {
        // Mengambil Jabatan Akademik dari route model binding.
        $jabatanAkademik = $this->route('jabatan_akademik');

        return [

            // Nama Jabatan Akademik wajib diisi, berupa teks,
            // maksimal 100 karakter, dan tetap harus unik.
            'nama' => [
                'required',
                'string',
                'max:100',

                // Mengabaikan data Jabatan Akademik yang sedang diedit
                // agar nama yang sama dengan dirinya sendiri tetap diperbolehkan.
                Rule::unique('jabatan_akademiks', 'nama')
                    ->ignore($jabatanAkademik?->id),
            ],

            // Golongan Minimal wajib dipilih dan harus tersedia.
            'golongan_min_id' => [
                'required',
                'exists:golongans,id',
            ],

            // Golongan Maksimal wajib dipilih dan harus tersedia.
            'golongan_max_id' => [
                'required',
                'exists:golongans,id',
            ],

            // Usia Pensiun wajib diisi berupa angka antara 1 sampai 100.
            'usia_pensiun' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            // Maks. KGB Setelah Mentok boleh kosong,
            // tetapi jika diisi harus berupa angka minimal 0.
            'maks_kgb_setelah_mentok' => [
                'nullable',
                'integer',
                'min:0',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama Jabatan Akademik belum diisi.
            'nama.required' => 'Nama Jabatan Akademik wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Jabatan Akademik harus berupa teks.',

            // Pesan ketika nama terlalu panjang.
            'nama.max' => 'Nama Jabatan Akademik maksimal 100 karakter.',

            // Pesan ketika nama sudah digunakan Jabatan Akademik lain.
            'nama.unique' => 'Nama Jabatan Akademik sudah terdaftar.',

            // Pesan ketika Golongan Minimal belum dipilih.
            'golongan_min_id.required' => 'Golongan Minimal wajib dipilih.',

            // Pesan ketika Golongan Minimal tidak ditemukan.
            'golongan_min_id.exists' => 'Golongan Minimal yang dipilih tidak valid.',

            // Pesan ketika Golongan Maksimal belum dipilih.
            'golongan_max_id.required' => 'Golongan Maksimal wajib dipilih.',

            // Pesan ketika Golongan Maksimal tidak ditemukan.
            'golongan_max_id.exists' => 'Golongan Maksimal yang dipilih tidak valid.',

            // Pesan ketika Usia Pensiun belum diisi.
            'usia_pensiun.required' => 'Usia Pensiun wajib diisi.',

            // Pesan ketika Usia Pensiun bukan angka.
            'usia_pensiun.integer' => 'Usia Pensiun harus berupa angka.',

            // Pesan ketika Usia Pensiun kurang dari batas minimal.
            'usia_pensiun.min' => 'Usia Pensiun minimal 1 tahun.',

            // Pesan ketika Usia Pensiun melebihi batas maksimal.
            'usia_pensiun.max' => 'Usia Pensiun maksimal 100 tahun.',

            // Pesan ketika Maks. KGB Setelah Mentok bukan angka.
            'maks_kgb_setelah_mentok.integer' => 'Maks. KGB Setelah Mentok harus berupa angka.',

            // Pesan ketika Maks. KGB Setelah Mentok kurang dari 0.
            'maks_kgb_setelah_mentok.min' => 'Maks. KGB Setelah Mentok minimal 0.',

        ];
    }

    /**
     * Menentukan nama field yang ditampilkan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'nama' => 'Nama Jabatan Akademik',

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'golongan_min_id' => 'Golongan Minimal',

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'golongan_max_id' => 'Golongan Maksimal',

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'usia_pensiun' => 'Usia Pensiun',

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'maks_kgb_setelah_mentok' => 'Maks. KGB Setelah Mentok',

        ];
    }
}
