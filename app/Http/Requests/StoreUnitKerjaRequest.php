<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitKerjaRequest extends FormRequest
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
     * Menentukan aturan validasi untuk membuat Unit Kerja baru.
     */
    public function rules(): array
    {
        return [

            // Nama Unit Kerja wajib diisi, berupa teks,
            // maksimal 255 karakter, dan tidak boleh duplikat.
            'nama' => [
                'required',
                'string',
                'max:255',
                'unique:unit_kerjas,nama',
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

            // Pesan ketika nama sudah digunakan.
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
