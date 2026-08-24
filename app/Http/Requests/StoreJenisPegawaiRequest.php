<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisPegawaiRequest extends FormRequest
{
    /**
     * Menentukan apakah user diperbolehkan menjalankan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Menentukan aturan validasi saat membuat Jenis Pegawai.
     */
    public function rules(): array
    {
        return [

            // Nama Jenis Pegawai wajib diisi dan tidak boleh duplicate.
            'nama' => [
                'required',
                'string',
                'max:50',
                'unique:jenis_pegawais,nama',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            'nama.required' => 'Nama Jenis Pegawai wajib diisi.',

            'nama.string' => 'Nama Jenis Pegawai harus berupa teks.',

            'nama.max' => 'Nama Jenis Pegawai maksimal 50 karakter.',

            'nama.unique' => 'Nama Jenis Pegawai sudah terdaftar.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            'nama' => 'Nama Jenis Pegawai',

        ];
    }
}
