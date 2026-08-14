<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\JenisPegawai;

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

            // NUPTK wajib untuk Dosen dan opsional untuk Tendik.
            // Jika diisi, NUPTK harus unik.
            'nuptk' => [
                'bail',
                'nullable',
                'string',
                'max:50',
                Rule::requiredIf(function () {
                    return $this->isDosen();
                }),
                'unique:pegawais,nuptk',
            ],

            // Nomor sertifikasi dosen boleh kosong.
            'no_serdos' => [
                'nullable',
                'string',
                'max:50',
                Rule::requiredIf(function () {
                    return $this->isDosen();
                }),
                'unique:pegawais,no_serdos',
            ],

            // Tanggal sertifikasi dosen boleh kosong.
            'tanggal_serdos' => [
                'nullable',
                'date',
            ],

            // Jenis dosen hanya boleh Tetap atau Tidak Tetap.
            'jenis_dosen' => [
                Rule::requiredIf(function () {
                    return $this->isDosen();
                }),
                'nullable',
                Rule::in([
                    'Tetap',
                    'Tidak Tetap',
                ]),
            ],

            // Jenis tendik hanya boleh menggunakan pilihan yang sudah ditentukan.
            'jenis_tendik' => [
                Rule::requiredIf(function () {
                    return $this->isTendik();
                }),
                'nullable',
                Rule::in([
                    'Tendik Tetap',
                    'Tendik Tidak Tetap',
                    'Tendik Outsourcing',
                ]),
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

            'program_studi_id' => [
                'nullable',

                // Memastikan Program Studi benar-benar ada di tabel program_studis.
                Rule::exists('program_studis', 'id')

                    // Memastikan Program Studi yang dipilih memang milik Unit Kerja yang dipilih.
                    ->where(function ($query) {
                        $query->where('unit_kerja_id', $this->unit_kerja_id);
                    }),
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

    protected function isDosen(): bool
    {
        $jenisPegawai = JenisPegawai::find($this->jenis_pegawai_id);

        return $jenisPegawai?->nama === JenisPegawai::DOSEN;
    }

    protected function isTendik(): bool
    {
        $jenisPegawai = JenisPegawai::find($this->jenis_pegawai_id);

        return $jenisPegawai?->nama === JenisPegawai::TENDIK;
    }

    public function messages(): array
    {
        return [

            'nama.required' => 'Nama lengkap wajib diisi.',

            'nipy.required' => 'NIPY wajib diisi.',

            'nipy.unique' => 'NIPY sudah terdaftar.',

            'nuptk.required' => 'NUPTK wajib diisi untuk Dosen.',

            'nuptk.unique' => 'NUPTK sudah terdaftar.',

            'nuptk.max' => 'NUPTK maksimal 50 karakter.',

            'no_serdos.max' => 'Nomor Serdos maksimal 50 karakter.',

            'no_serdos.unique' => 'Nomor Serdos sudah terdaftar.',

            'tanggal_serdos.date' => 'Tanggal Serdos harus berupa tanggal yang valid.',

            'jenis_dosen.in' => 'Jenis dosen harus Tetap atau Tidak Tetap.',

            'jenis_tendik.in' => 'Jenis tendik tidak valid.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',

            'agama_id.required' => 'Agama wajib dipilih.',

            'pendidikan_id.required' => 'Pendidikan wajib dipilih.',

            'unit_kerja_id.required' => 'Unit kerja wajib dipilih.',

            'program_studi_id.exists' => 'Program Studi tidak valid atau tidak sesuai dengan Unit Kerja.',

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

            'nuptk' => 'NUPTK',

            'no_serdos' => 'Nomor Serdos',

            'tanggal_serdos' => 'Tanggal Serdos',

            'jenis_dosen' => 'Jenis Dosen',

            'jenis_tendik' => 'Jenis Tendik',

            'nama' => 'Nama Lengkap',

            'tempat_lahir' => 'Tempat Lahir',

            'tanggal_lahir' => 'Tanggal Lahir',

            'agama_id' => 'Agama',

            'pendidikan_id' => 'Pendidikan',

            'unit_kerja_id' => 'Unit Kerja',

            'program_studi_id' => 'Program Studi',

            'status_pegawai_id' => 'Status Pegawai',

            'tmt' => 'TMT',

            'jenis_kelamin' => 'Jenis Kelamin',

            'golongan_id' => 'Golongan',

            'jabatan_akademik_id' => 'Jabatan Akademik',

        ];
    }
}
