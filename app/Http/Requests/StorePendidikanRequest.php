<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StorePendidikanRequest extends FormRequest
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
            'nama' => [
                'required',
                'string',
                'max:50',
                'unique:pendidikans,nama',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Pendidikan wajib diisi',
            'nama.string' => 'Pendidikan harus berupa teks',
            'nama.max' => 'Pendidikan maksimal 50 karakter',
            'nama.unique' => 'Pendidikan sudah terdaftar',
        ];
    }

  
    public function attributes(): array
    {
        return [
            'nama' => 'Nama Pendidikan',
        ];
    }
}
