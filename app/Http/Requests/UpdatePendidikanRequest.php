<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePendidikanRequest extends FormRequest
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
     * Menentukan aturan validasi saat memperbarui Pendidikan.
     */
    public function rules(): array
    {
        // Mengambil data Pendidikan dari route model binding.
        $pendidikan = $this->route('pendidikan');

        return [

            // Nama Pendidikan wajib diisi dan harus unik,
            // tetapi data yang sedang diedit dikecualikan dari pengecekan.
            'nama' => [
                'required',
                'string',
                'max:50',
                Rule::unique('pendidikans', 'nama')
                    ->ignore($pendidikan?->id),
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama Pendidikan tidak diisi.
            'nama.required' => 'Nama Pendidikan wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Pendidikan harus berupa teks.',

            // Pesan ketika nama terlalu panjang.
            'nama.max' => 'Nama Pendidikan maksimal 50 karakter.',

            // Pesan ketika nama sudah digunakan Pendidikan lain.
            'nama.unique' => 'Nama Pendidikan sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field database menjadi label yang mudah dipahami.
            'nama' => 'Nama Pendidikan',

        ];
    }
}
