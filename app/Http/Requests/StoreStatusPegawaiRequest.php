<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusPegawaiRequest extends FormRequest
{
    /**
     * Menentukan apakah user diperbolehkan menjalankan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Menentukan aturan validasi saat membuat Status Pegawai.
     */
    public function rules(): array
    {
        return [

            // Nama wajib diisi dan tidak boleh duplicate.
            'nama' => [
                'required',
                'string',
                'max:50',
                'unique:status_pegawais,nama',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi.
     */
    public function messages(): array
    {
        return [

            'nama.required' => 'Nama Status Pegawai wajib diisi.',

            'nama.string' => 'Nama Status Pegawai harus berupa teks.',

            'nama.max' => 'Nama Status Pegawai maksimal 50 karakter.',

            'nama.unique' => 'Nama Status Pegawai sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            'nama' => 'Nama Status Pegawai',

        ];
    }
}
