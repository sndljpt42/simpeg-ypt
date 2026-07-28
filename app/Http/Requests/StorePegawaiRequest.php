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
                'bail',
                'required',
                'string',
                'max:50',
                'unique:pegawais,nipy',
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

    public function messages(): array
    {
        return [

            'nama.required' => 'Nama lengkap wajib diisi.',

            'nipy.required' => 'NIPY wajib diisi.',

            'nipy.unique' => 'NIPY sudah terdaftar.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',

            'agama_id.required' => 'Agama wajib dipilih.',

            'pendidikan_id.required' => 'Pendidikan wajib dipilih.',

            'unit_kerja_id.required' => 'Unit kerja wajib dipilih.',

            'status_pegawai_id.required' => 'Status pegawai wajib dipilih.',

            'tmt.required' => 'TMT wajib diisi.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

            'golongan_id.exists' => 'Golongan tidak valid.',

            'jabatan_akademik_id.exists' => 'Jabatan akademik tidak valid.',

            'golongan_id.required' => 'Golongan wajib dipilih.',

            'jabatan_akademik_id.required' => 'Jabatan akademik wajib dipilih.',

        ];
    }

    public function attributes(): array
{
    return [

        'nipy' => 'NIPY',

        'nama' => 'Nama Lengkap',

        'tempat_lahir' => 'Tempat Lahir',

        'tanggal_lahir' => 'Tanggal Lahir',

        'agama_id' => 'Agama',

        'pendidikan_id' => 'Pendidikan',

        'unit_kerja_id' => 'Unit Kerja',

        'status_pegawai_id' => 'Status Pegawai',

        'tmt' => 'TMT',

        'jenis_kelamin' => 'Jenis Kelamin',

        'golongan_id' => 'Golongan',

        'jabatan_akademik_id' => 'Jabatan Akademik',

    ];
}

}
