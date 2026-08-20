<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgramStudiRequest extends FormRequest
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
     * Menentukan aturan validasi saat memperbarui Program Studi.
     */
    public function rules(): array
    {
        // Mengambil Program Studi dari route model binding.
        $programStudi = $this->route('program_studi');

        return [

            // Unit Kerja wajib dipilih dan harus tersedia di master Unit Kerja.
            'unit_kerja_id' => [
                'required',
                'exists:unit_kerjas,id',
            ],

            // Nama Program Studi wajib diisi dan harus unik.
            // Record yang sedang diedit dikecualikan dari pengecekan unique.
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('program_studis', 'nama')
                    ->ignore($programStudi?->id),
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

            // Pesan ketika Unit Kerja tidak ditemukan.
            'unit_kerja_id.exists' => 'Unit Kerja tidak valid.',

            // Pesan ketika nama Program Studi belum diisi.
            'nama.required' => 'Nama Program Studi wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Program Studi harus berupa teks.',

            // Pesan ketika nama terlalu panjang.
            'nama.max' => 'Nama Program Studi maksimal 255 karakter.',

            // Pesan ketika nama sudah digunakan oleh Program Studi lain.
            'nama.unique' => 'Nama Program Studi sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'unit_kerja_id' => 'Unit Kerja',

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'nama' => 'Nama Program Studi',

        ];
    }
}
