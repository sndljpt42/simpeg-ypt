<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pegawai;

class StoreDokumenRequest extends FormRequest
{
    /**
     * Menentukan apakah user boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        //hanya role yang diizinkan policy boleh membuat repository
        return $this->user()?->can('create', Pegawai::class) ?? false;
    }

    /**
     * Menentukan aturan validasi data Dokumen.
     */
    public function rules(): array
    {
        return [

            // Nama dokumen wajib diisi dan maksimal 255 karakter.
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            // Deskripsi boleh dikosongkan.
            'deskripsi' => [
                'nullable',
                'string',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama dokumen tidak diisi.
            'nama.required' => 'Nama dokumen wajib diisi.',

            // Pesan ketika nama dokumen bukan berupa teks.
            'nama.string' => 'Nama dokumen harus berupa teks.',

            // Pesan ketika nama dokumen terlalu panjang.
            'nama.max' => 'Nama dokumen maksimal 255 karakter.',

            // Pesan ketika deskripsi bukan berupa teks.
            'deskripsi.string' => 'Deskripsi harus berupa teks.',

        ];
    }

    /**
     * Menentukan nama field yang ditampilkan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            'nama' => 'Nama Dokumen',

            'deskripsi' => 'Deskripsi',

        ];
    }
}
