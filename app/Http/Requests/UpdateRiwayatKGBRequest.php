<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiwayatKGBRequest extends FormRequest
{
    /**
     * Menentukan apakah user boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        // Akses route sudah dilindungi oleh middleware auth.
        return true;
    }

    /**
     * Menentukan aturan validasi data Riwayat KGB.
     */
    public function rules(): array
    {
        return [

            // Nomor SK wajib diisi, berupa teks,
            // dan maksimal 50 karakter.
            'nomor_sk' => [
                'required',
                'string',
                'max:50',
            ],

            // Tanggal SK wajib diisi dan harus berupa tanggal yang valid.
            'tanggal_sk' => [
                'required',
                'date',
            ],

            // TMT wajib diisi dan harus berupa tanggal yang valid.
            'tmt' => [
                'required',
                'date',
            ],

            // Keterangan boleh dikosongkan dan jika diisi harus berupa teks.
            'keterangan' => [
                'nullable',
                'string',
            ],

        ];
    }

    /**
     * Menentukan pesan validasi yang lebih mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika Nomor SK tidak diisi.
            'nomor_sk.required' => 'Nomor SK wajib diisi.',

            // Pesan ketika Nomor SK bukan berupa teks.
            'nomor_sk.string' => 'Nomor SK harus berupa teks.',

            // Pesan ketika Nomor SK melebihi batas karakter.
            'nomor_sk.max' => 'Nomor SK maksimal 50 karakter.',

            // Pesan ketika Tanggal SK tidak diisi.
            'tanggal_sk.required' => 'Tanggal SK wajib diisi.',

            // Pesan ketika Tanggal SK bukan tanggal yang valid.
            'tanggal_sk.date' => 'Tanggal SK tidak valid.',

            // Pesan ketika TMT tidak diisi.
            'tmt.required' => 'TMT wajib diisi.',

            // Pesan ketika TMT bukan tanggal yang valid.
            'tmt.date' => 'TMT tidak valid.',

            // Pesan ketika Keterangan bukan berupa teks.
            'keterangan.string' => 'Keterangan harus berupa teks.',

        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'nomor_sk' => 'Nomor SK',

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'tanggal_sk' => 'Tanggal SK',

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'tmt' => 'TMT',

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'keterangan' => 'Keterangan',

        ];
    }
}
