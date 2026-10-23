<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDokumenVersionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Upload versi dianggap perubahan pada dokumen milik pegawai ini.
        return $this->user()?->can('update', $this->route('pegawai')) ?? false;
    }

    /**
     * Memastikan file versi tersedia, bertipe dokumen yang didukung,
     * dan tidak melebihi batas ukuran 3 MB.
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:3072', //3 MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File dokumen wajib dipilih.',
            'file.file' => 'File yang dipilih tidak valid.',
            'file.mimes' => 'File harus berformat PDF, JPG, atau PNG.',
            'file.max' => 'Ukuran file maksimal 3MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'file' => 'File Dokumen'
        ];
    }
}
