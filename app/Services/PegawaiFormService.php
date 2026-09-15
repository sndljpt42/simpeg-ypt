<?php

namespace App\Services;

use App\Models\Agama;
use App\Models\Golongan;
use App\Models\JabatanAkademik;
use App\Models\Pendidikan;
use App\Models\StatusPegawai;
use App\Models\UnitKerja;

class PegawaiFormService
{
    /**
     * Mengambil seluruh data master
     * yang digunakan pada form pegawai.
     */
    public function getMasterData(): array
    {
        return [
            'agamas' => Agama::orderBy('nama')->get(),
            'pendidikans' => Pendidikan::orderBy('nama')->get(),
            
            // Gunakan Unit Kerja yang sudah disusun berdasarkan hierarchy.
            'unitKerjas' => $this->getUnitKerjaHierarchy(),
           
            'golongans' => Golongan::orderBy('kode')->get(),
            'jabatanAkademiks' => JabatanAkademik::orderBy('nama')->get(),
            'statusPegawais' => StatusPegawai::orderBy('nama')->get(),
        ];
    }

    // Menyusun Unit Kerja dari parent kemudian ke child.
    private function getUnitKerjaHierarchy()
    {
        // Ambil semua Unit Kerja.
        $unitKerjas = UnitKerja::orderBy('nama')->get();

        // Kelompokkan berdasarkan parent_id.
        $grouped = $unitKerjas->groupBy('parent_id');

        // Mulai dari Unit Kerja paling atas (parent_id = null).
        return $this->flattenUnitKerjaHierarchy($grouped, null);
    }

    // Mengubah struktur hierarchy menjadi daftar untuk dropdown.
    private function flattenUnitKerjaHierarchy($grouped, $parentId, int $level = 0)
    {
        $result = collect();

        foreach ($grouped->get($parentId, collect()) as $unit) {

            // Menyimpan level agar Blade tahu berapa indentasinya.
            $unit->setAttribute('hierarchy_level', $level);

            // Masukkan parent terlebih dahulu.
            $result->push($unit);

            // Setelah parent, masukkan semua child-nya.
            $result = $result->merge(
                $this->flattenUnitKerjaHierarchy(
                    $grouped,
                    $unit->id,
                    $level + 1
                )
            );
        }

        return $result;
    }
}
