<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //jenis pegawai harus dipilih dan harus ada di table master
            'jenis_pegawai_id' => [
                'required',
                'exists:jenis_pegawais,id'
            ],

            //nama wajib diisi
            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            //nipy wajib dan unik
            'nipy' => [
                'required',
                'string',
                'max:50',
                'unique:pegawai,nipy',
            ],
            
            //NIDN boleh kosong
            'nidn' => [
                'nullable',
                'string',
                'max:50',
            ],

            //tempat lahir wajib diisi
            'tempat_lahir' => [
                'required',
                'string',
                'max:100'
            ],

            //tanggal lahir wajib diisi dan harus berupa tanggal
            'tanggal_lahir' => [
                'required',
                'date'
            ],

            //jenis kelamin wajib diisi dan harus L atau P
            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P'])    
            ],

            //agama
            'agama_id' => [
                'required',
                'exists:agamas,id'
            ],

            //tmt
            'tmt' => [
                'required',
                'date'
            ],

            //pendidikan
            'pendidikan_id' => [
                'required',
                'exists:pendidikans,id'
            ],

            //unitkerja
            'unit_kerja_id' => [
                'required',
                'exists:unit_kerjas,id'
            ],

            //status pegawai
            'status_pegawai_id' => [
                'required',
                'exists:status_pegawais,id'
            ],

            //golongan boleh kosong
            'golongan_id' => [
                'nullable',
                'exists:golongans,id'
            ],

            //jabatan akademik boleh kosong
            'jabatan_akademik_id' => [
                'nullable',
                'exists:jabatan_akademiks,id'
            ],
        ];
    }
}
