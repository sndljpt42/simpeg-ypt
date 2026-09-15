<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\UnitKerja;

class UpdateUnitKerjaRequest extends FormRequest
{
    /**
     * Menentukan apakah user diperbolehkan menjalankan request ini.
     */
    public function authorize(): bool
    {
        // Untuk saat ini request diperbolehkan.
        return true;
    }

    /**
     * Menentukan aturan validasi untuk memperbarui Unit Kerja.
     */
    public function rules(): array
    {
        // Mengambil Unit Kerja dari route berdasarkan route model binding.
        $unitKerja = $this->route('unit_kerja');

        return [

            // Nama Unit Kerja wajib diisi, berupa teks,
            // maksimal 255 karakter, dan tetap harus unik.
            'nama' => [
                'required',
                'string',
                'max:255',

                // Mengabaikan data Unit Kerja yang sedang diedit
                // agar nama yang sama dengan dirinya sendiri tetap diperbolehkan.
                Rule::unique('unit_kerjas', 'nama')
                    ->ignore($unitKerja),
            ],

            // Unit Kerja induk boleh kosong untuk Unit Kerja tingkat atas.
            'parent_id' => [
                'nullable',
                'integer',
                'exists:unit_kerjas,id',

                // Unit Kerja tidak boleh menjadi induk bagi dirinya sendiri.
                Rule::notIn([$unitKerja->id]),
            ],

        ];
    }

    //validasi mencegah circular reference, misal unit kerja A menjadi induk unit kerja B, dan unit kerja B menjadi induk unit kerja A.

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Jika parent_id tidak diisi, Unit Kerja menjadi root,
            // sehingga tidak mungkin membentuk circular reference.
            if (!$this->filled('parent_id')) {
                return;
            }

            //mengambil unit kerja yang sedang di edit dari route model binding.
            $unitKerja = $this->route('unit_kerja');

            //jika unit kerja tidak ditemukan, hentikan validasi.
            if (!$unitKerja) {
                return;
            }

            //mengambil id parent yang dipilih.
            $parentId = (int) $this->input('parent_id');

            //mengambil seluruh id keturunan unit kerja yang sedang di edit
            $descendantIds = $this->getDescendantIds($unitKerja);

            // Jika parent yang dipilih merupakan salah satu keturunan,
            // maka struktur akan membentuk siklus.
            if (in_array($parentId, $descendantIds, true)) {
                $validator->errors()->add(
                    'parent_id',
                    'Unit Kerja induk tidak boleh merupakan keturunan dari Unit Kerja yang sedang diedit.'
                );
            }
        });
    }

    //mengambil seuluruh ID unit kerja yang menjadi Keturunan dari Unit Kerja Tertentu

    private function getDescendantIds(UnitKerja $unitKerja): array {
        $descendantIds = [];

        //mengambil children langsung dari Unit Kerja
        $children = $unitKerja->children()->get();

        foreach($children as $child){
            //menambahkan ID child ke daftar urutan
            $descendantIds[] = $child->id;
            //memanggil rekursif untuk mengambil keturunan dari child
            $descendantIds = array_merge($descendantIds, $this->getDescendantIds($child));  
        }

        return $descendantIds;
    }
    /**
     * Menentukan pesan validasi yang lebih mudah dipahami user.
     */
    public function messages(): array
    {
        return [

            // Pesan ketika nama Unit Kerja tidak diisi.
            'nama.required' => 'Nama Unit Kerja wajib diisi.',

            // Pesan ketika nama bukan berupa teks.
            'nama.string' => 'Nama Unit Kerja harus berupa teks.',

            // Pesan ketika nama melebihi batas karakter.
            'nama.max' => 'Nama Unit Kerja maksimal 255 karakter.',

            // Pesan ketika nama sudah digunakan oleh Unit Kerja lain.
            'nama.unique' => 'Nama Unit Kerja sudah terdaftar.',

            'parent_id.integer' => 'Unit Kerja induk tidak valid.',

            'parent_id.exists' => 'Unit Kerja induk yang dipilih tidak ditemukan.',

            'parent_id.not_in' => 'Unit Kerja tidak boleh menjadi induk bagi dirinya sendiri.',
        ];
    }

    /**
     * Menentukan nama field yang digunakan pada pesan validasi.
     */
    public function attributes(): array
    {
        return [

            // Mengubah nama field teknis menjadi nama yang lebih ramah.
            'nama' => 'Nama Unit Kerja',
            'parent_id' => 'Unit Kerja Induk',

        ];
    }
}
