<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAgamaRequest extends FormRequest
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
     * Menentukan aturan validasi saat memperbarui Agama.
     */
    public function rules(): array
    {
        // Mengambil data Agama dari route model binding.
        $agama = $this->route('agama');

        return [

            // Nama Agama wajib diisi dan harus unik.
            // Data Agama yang sedang diedit dikecualikan dari pengecekan unique.
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('agamas', 'nama')
                    ->ignore($agama?->id),
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama Agama tidak diisi.
            'nama.required' => 'Nama Agama wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Agama harus berupa teks.',

            // Pesan ketika nama terlalu panjang.
            'nama.max' => 'Nama Agama maksimal 255 karakter.',

            // Pesan ketika nama sudah digunakan oleh Agama lain.
            'nama.unique' => 'Nama Agama sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field database menjadi label yang lebih mudah dipahami.
            'nama' => 'Nama Agama',

        ];
    }
}
