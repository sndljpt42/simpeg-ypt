<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGolonganRequest extends FormRequest
{
    /**
     * Menyiapkan data sebelum proses validasi.
     */
    protected function prepareForValidation(): void
    {
        // Membentuk kode dari Golongan dan Ruang.
        $this->merge([
            'kode' => $this->golongan . '/' . $this->ruang,
        ]);
    }

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
            'golongan' => [
                'required',
                'string',
                'max:10',
            ],

            'ruang' => [
                'required',
                'string',
                'max:5',
            ],

            'kode' => [
                'required',
                'string',
                'max:10',
                Rule::unique('golongans', 'kode')
                    ->ignore($this->route('golongan')?->id),
            ],
        ];
    }

    /**
     * Pesan error validasi.
     */
    public function messages(): array
    {
        return [
            'golongan.required' => 'Golongan wajib diisi.',
            'golongan.string' => 'Golongan harus berupa teks.',
            'golongan.max' => 'Golongan maksimal 10 karakter.',

            'ruang.required' => 'Ruang wajib diisi.',
            'ruang.string' => 'Ruang harus berupa teks.',
            'ruang.max' => 'Ruang maksimal 5 karakter.',

            'kode.required' => 'Kode Golongan wajib diisi.',
            'kode.unique' => 'Kombinasi Golongan dan Ruang tersebut sudah terdaftar.',
        ];
    }
}
