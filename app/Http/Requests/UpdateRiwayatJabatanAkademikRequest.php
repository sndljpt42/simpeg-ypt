<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiwayatJabatanAkademikRequest extends FormRequest
{
    /**
     * Menentukan apakah user boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        // Route sudah dilindungi oleh middleware auth.
        return true;
    }

    /**
     * Aturan validasi data saat mengubah riwayat.
     */
    public function rules(): array
    {
        return [
            // Jabatan Akademik wajib dipilih.
            'jabatan_akademik_id' => [
                'required',
                'integer',
                'exists:jabatan_akademiks,id',
            ],

            // Nomor SK wajib diisi.
            'nomor_sk' => [
                'required',
                'string',
                'max:100',
            ],

            // Tanggal SK wajib diisi.
            'tanggal_sk' => [
                'required',
                'date',
            ],

            // TMT wajib diisi.
            'tmt' => [
                'required',
                'date',
            ],

            // Keterangan boleh kosong.
            'keterangan' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Pesan validasi.
     */
    public function messages(): array
    {
        return [
            'jabatan_akademik_id.required' =>
            'Jabatan Akademik wajib dipilih.',

            'jabatan_akademik_id.integer' =>
            'Jabatan Akademik yang dipilih tidak valid.',

            'jabatan_akademik_id.exists' =>
            'Jabatan Akademik yang dipilih tidak ditemukan.',

            'nomor_sk.required' =>
            'Nomor SK wajib diisi.',

            'nomor_sk.max' =>
            'Nomor SK maksimal 100 karakter.',

            'tanggal_sk.required' =>
            'Tanggal SK wajib diisi.',

            'tanggal_sk.date' =>
            'Tanggal SK tidak valid.',

            'tmt.required' =>
            'TMT wajib diisi.',

            'tmt.date' =>
            'TMT tidak valid.',

            'keterangan.string' =>
            'Keterangan harus berupa teks.',
        ];
    }

    /**
     * Nama field yang ditampilkan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [
            'jabatan_akademik_id' => 'Jabatan Akademik',
            'nomor_sk' => 'Nomor SK',
            'tanggal_sk' => 'Tanggal SK',
            'tmt' => 'TMT',
            'keterangan' => 'Keterangan',
        ];
    }
}
