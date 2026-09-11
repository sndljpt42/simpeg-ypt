<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJabatanAkademikRequest extends FormRequest
{
    /**
     * Menentukan apakah request diizinkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                'unique:jabatan_akademiks,nama',
            ],

            'golongan_min_id' => [
                'required',
                'exists:golongans,id',
            ],

            'golongan_max_id' => [
                'required',
                'exists:golongans,id',
            ],

            'usia_pensiun' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'maks_kgb_setelah_mentok' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }

    /**
     * Pesan error validasi.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama Jabatan Akademik wajib diisi.',
            'nama.string' => 'Nama Jabatan Akademik harus berupa teks.',
            'nama.max' => 'Nama Jabatan Akademik maksimal 100 karakter.',
            'nama.unique' => 'Nama Jabatan Akademik sudah terdaftar.',

            'golongan_min_id.required' => 'Golongan Minimal wajib dipilih.',
            'golongan_min_id.exists' => 'Golongan Minimal yang dipilih tidak valid.',

            'golongan_max_id.required' => 'Golongan Maksimal wajib dipilih.',
            'golongan_max_id.exists' => 'Golongan Maksimal yang dipilih tidak valid.',

            'usia_pensiun.required' => 'Usia Pensiun wajib diisi.',
            'usia_pensiun.integer' => 'Usia Pensiun harus berupa angka.',
            'usia_pensiun.min' => 'Usia Pensiun minimal 1 tahun.',
            'usia_pensiun.max' => 'Usia Pensiun maksimal 100 tahun.',

            'maks_kgb_setelah_mentok.integer' => 'Maks. KGB Setelah Mentok harus berupa angka.',
            'maks_kgb_setelah_mentok.min' => 'Maks. KGB Setelah Mentok minimal 0.',
        ];
    }
}
