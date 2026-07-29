<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePegawaiRequest extends FormRequest
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
        $pegawai = $this->route('dosen') ?? $this->route('tendik');

        return [
            'jenis_pegawai_id' => [
                'required',
                'exists:jenis_pegawais,id',
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'nipy' => [
                'required',
                'string',
                'max:50',
                Rule::unique('pegawais', 'nipy')->ignore($pegawai),
            ],

            'nidn' => [
                'nullable',
                'string',
                'max:50',
            ],

            'tempat_lahir' => [
                'required',
                'string',
                'max:100',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],

            'agama_id' => [
                'required',
                'exists:agamas,id',
            ],

            'tmt' => [
                'required',
                'date',
            ],

            
            //pendidikan
            'pendidikan_id' => [
                'required',
                'exists:pendidikans,id'
            ],

            'unit_kerja_id' => [
                'required',
                'exists:unit_kerjas,id',
            ],

            'status_pegawai_id' => [
                'required',
                'exists:status_pegawais,id',
            ],

            'golongan_id' => [
                'nullable',
                'exists:golongans,id',
            ],

            'jabatan_akademik_id' => [
                'nullable',
                'exists:jabatan_akademiks,id',
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
}
