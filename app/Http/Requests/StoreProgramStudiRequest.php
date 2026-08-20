<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramStudiRequest extends FormRequest
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
     * Menentukan aturan validasi saat membuat Program Studi.
     */
    public function rules(): array
    {
        return [

            // Unit Kerja wajib dipilih dan harus tersedia di master Unit Kerja.
            'unit_kerja_id' => [
                'required',
                'exists:unit_kerjas,id',
            ],

            // Nama Program Studi wajib diisi dan harus unik.
            'nama' => [
                'required',
                'string',
                'max:255',
                'unique:program_studis,nama',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika Unit Kerja belum dipilih.
            'unit_kerja_id.required' => 'Unit Kerja wajib dipilih.',

            // Pesan ketika Unit Kerja tidak ditemukan di database.
            'unit_kerja_id.exists' => 'Unit Kerja tidak valid.',

            // Pesan ketika nama Program Studi belum diisi.
            'nama.required' => 'Nama Program Studi wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Program Studi harus berupa teks.',

            // Pesan ketika nama melebihi batas karakter.
            'nama.max' => 'Nama Program Studi maksimal 255 karakter.',

            // Pesan ketika nama Program Studi sudah digunakan.
            'nama.unique' => 'Nama Program Studi sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang ditampilkan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            
            'unit_kerja_id' => 'Unit Kerja',

            'nama' => 'Nama Program Studi',

        ];
    }
}
