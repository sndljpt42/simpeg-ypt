<?php

namespace Tests\Feature;

use App\Models\UnitKerja;
use App\Http\Requests\UpdateUnitKerjaRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UnitKerjaHierarchyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan Unit Kerja dapat menemukan seluruh keturunannya.
     */
    public function test_unit_kerja_dapat_menemukan_seluruh_keturunan(): void
    {
        $parent = UnitKerja::create([
            'nama' => 'Unit Test Parent',
            'parent_id' => null,
        ]);

        $child = UnitKerja::create([
            'nama' => 'Unit Test Child',
            'parent_id' => $parent->id,
        ]);

        $grandchild = UnitKerja::create([
            'nama' => 'Unit Test Grandchild',
            'parent_id' => $child->id,
        ]);

        $request = new UpdateUnitKerjaRequest();

        $method = new \ReflectionMethod(
            UpdateUnitKerjaRequest::class,
            'getDescendantIds'
        );

        $method->setAccessible(true);

        $descendantIds = $method->invoke($request, $parent);

        $this->assertContains($child->id, $descendantIds);
        $this->assertContains($grandchild->id, $descendantIds);
    }

    /**
     * Memastikan self-parent ditolak oleh rule parent_id.
     */
    public function test_self_parent_ditolak(): void
    {
        $unitKerja = UnitKerja::create([
            'nama' => 'Unit Test Parent',
            'parent_id' => null,
        ]);

        $rules = [
            'parent_id' => [
                'nullable',
                'integer',
                'exists:unit_kerjas,id',
                \Illuminate\Validation\Rule::notIn([$unitKerja->id]),
            ],
        ];

        $validator = Validator::make(
            [
                'parent_id' => $unitKerja->id,
            ],
            $rules
        );

        $this->assertTrue($validator->fails());

        $this->assertArrayHasKey(
            'parent_id',
            $validator->errors()->toArray()
        );
    }

    /**
     * Memastikan parent_id yang valid diterima.
     */
    public function test_parent_valid_diterima(): void
    {
        $parent = UnitKerja::create([
            'nama' => 'Unit Test Parent',
            'parent_id' => null,
        ]);

        $unitKerja = UnitKerja::create([
            'nama' => 'Unit Test Child',
            'parent_id' => null,
        ]);

        $validator = Validator::make(
            [
                'parent_id' => $parent->id,
            ],
            [
                'parent_id' => [
                    'nullable',
                    'integer',
                    'exists:unit_kerjas,id',
                    \Illuminate\Validation\Rule::notIn([$unitKerja->id]),
                ],
            ]
        );

        $this->assertFalse($validator->fails());
    }

    /**
     * Memastikan parent_id NULL diterima sebagai root.
     */
    public function test_parent_null_diterima(): void
    {
        $validator = Validator::make(
            [
                'parent_id' => null,
            ],
            [
                'parent_id' => [
                    'nullable',
                    'integer',
                    'exists:unit_kerjas,id',
                ],
            ]
        );

        $this->assertFalse($validator->fails());
    }
}
