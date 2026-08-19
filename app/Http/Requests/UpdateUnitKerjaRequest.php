<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnitKerjaRequest extends FormRequest
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
     * Menentukan aturan validasi untuk memperbarui Unit Kerja.
     */
    public function rules(): array
    {
        // Mengambil Unit Kerja dari route berdasarkan route model binding.
        $unitKerja = $this->route('unit_kerja');

        return [

            // Nama Unit Kerja wajib diisi, berupa teks,
            // maksimal 255 karakter, dan tetap harus unik.
            'nama' => [
                'required',
                'string',
                'max:255',

                // Mengabaikan data Unit Kerja yang sedang diedit
                // agar nama yang sama dengan dirinya sendiri tetap diperbolehkan.
                Rule::unique('unit_kerjas', 'nama')
                    ->ignore($unitKerja),
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang lebih mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama Unit Kerja tidak diisi.
            'nama.required' => 'Nama Unit Kerja wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Unit Kerja harus berupa teks.',

            // Pesan ketika nama melebihi batas karakter.
            'nama.max' => 'Nama Unit Kerja maksimal 255 karakter.',

            // Pesan ketika nama sudah digunakan oleh Unit Kerja lain.
            'nama.unique' => 'Nama Unit Kerja sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'nama' => 'Nama Unit Kerja',

        ];
    }
}
