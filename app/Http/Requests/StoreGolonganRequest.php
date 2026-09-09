<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGolonganRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'golongan' => ['required', 'string', 'max:10'],
            'ruang' => ['required', 'string', 'max:5'],
        ];
    }

    /**
     * Get custom messages for validator errors.
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
        ];
    }
}
