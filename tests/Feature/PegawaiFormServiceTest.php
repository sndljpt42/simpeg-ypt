<?php

namespace Tests\Feature;

use App\Models\UnitKerja;
use App\Services\PegawaiFormService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiFormServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan Unit Kerja pada form Pegawai mengikuti hierarchy parent-child.
     */
    public function test_unit_kerja_form_pegawai_mengikuti_hierarchy(): void
    {
        // Buat struktur parent → child → grandchild.
        $parent = UnitKerja::create([
            'nama' => 'Unit Test Parent Pegawai',
            'parent_id' => null,
        ]);

        $child = UnitKerja::create([
            'nama' => 'Unit Test Child Pegawai',
            'parent_id' => $parent->id,
        ]);

        $grandchild = UnitKerja::create([
            'nama' => 'Unit Test Grandchild Pegawai',
            'parent_id' => $child->id,
        ]);

        $service = new PegawaiFormService();
        $unitKerjas = $service->getMasterData()['unitKerjas'];

        // Cari masing-masing Unit Kerja berdasarkan ID.
        $parentResult = $unitKerjas->firstWhere('id', $parent->id);
        $childResult = $unitKerjas->firstWhere('id', $child->id);
        $grandchildResult = $unitKerjas->firstWhere('id', $grandchild->id);

        // Pastikan ketiganya masuk ke data form.
        $this->assertNotNull($parentResult);
        $this->assertNotNull($childResult);
        $this->assertNotNull($grandchildResult);

        // Pastikan level hierarchy benar.
        $this->assertSame(0, $parentResult->hierarchy_level);
        $this->assertSame(1, $childResult->hierarchy_level);
        $this->assertSame(2, $grandchildResult->hierarchy_level);
    }
}
