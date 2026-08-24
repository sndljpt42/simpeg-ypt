<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJenisPegawaiRequest extends FormRequest
{
    /**
     * Menentukan apakah user diperbolehkan menjalankan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Menentukan aturan validasi saat memperbarui Jenis Pegawai.
     */
    public function rules(): array
    {
        // Mengambil Jenis Pegawai dari route model binding.
        $jenisPegawai = $this->route('jenis_pegawai');

        return [

            // Nama wajib diisi dan harus unik,
            // tetapi data yang sedang diedit dikecualikan.
            'nama' => [
                'required',
                'string',
                'max:50',
                Rule::unique('jenis_pegawais', 'nama')
                    ->ignore($jenisPegawai?->id),
            ],

        ];
    }

    /**
     * Menentukan pesan validasi.
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
     * Menentukan nama field pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            'nama' => 'Nama Jenis Pegawai',

        ];
    }
}
