<?php

namespace App\Http\Controllers\API\mitra;

use App\Dtos\MItraDto;
use App\Http\Controllers\Controller;
use App\Http\Services\MitraService;
use Illuminate\Http\Request;

class Mitra extends Controller
{
    private MitraService $mitraService;

    public function __construct(MitraService $mitraService)
    {
        $this->mitraService = $mitraService;
    }

    public function fetchAll()
    {
        return $this->mitraService->fetchAll();
    }

    public function store(Request $request)
    {
        $mitraDto = MItraDto::fromRequest($request);
        $arrayData = $mitraDto->toArray();

        return $this->mitraService->create($arrayData);
    }

    public function update(int $id, Request $request)
    {
        $mitraDto = MItraDto::fromRequest($request);
        $arrayData = $mitraDto->toArray();

        return $this->mitraService->update($id, $arrayData);
    }

    public function destroy(int $id)
    {
        $result = $this->mitraService->deleteMitra($id);

        if ($result['status'] === 'error') {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => $result['message'],
        ], 200);
    }
}
