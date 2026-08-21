<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreAgamaRequest extends FormRequest
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
            'nama' =>[
                'required',
                'string',
                'max:50',
                'unique:agamas,nama',
            ]
        ];
        
    }

    public function messages(): array
    {
        return[
            'nama.required' => 'Agama wajib diisi',
            'nama.string' => 'Agama harus berupa teks',
            'nama.max' => 'Agama maksimal 50 Karakter',
            'nama.unique' => 'Agama sudah terdaftar'
        ];
    }

    #[Override]
    public function attributes(): array
    {
        return [
            'nama' => 'Nama Agama',
        ];
    }
}
