<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ProgramStudi;
use App\Models\UnitKerja;

class ProgramStudiController extends Controller
{
    public function byUnitKerja(UnitKerja $unitKerja): JsonResponse
    {
        $programStudis = $unitKerja->programStudis()
            ->orderBy('nama')
            ->get([
                'id',
                'nama',
            ]);

        return response()->json($programStudis);
    }
}
