<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDokumenRequest extends FormRequest
{
    /**
     * Menentukan apakah user boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        // Periksa izin mengubah data pegawai yang terhubung ke dokumen ini.
        return $this->user()?->can('update', $this->route('pegawai')) ?? false;
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

            'nama.required' => 'Nama dokumen wajib diisi.',
            'nama.string' => 'Nama dokumen harus berupa teks.',
            'nama.max' => 'Nama dokumen maksimal 255 karakter.',

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
