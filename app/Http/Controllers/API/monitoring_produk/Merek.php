<?php

namespace App\Http\Controllers\API\monitoring_produk;

use App\Http\Controllers\Controller;
use App\Http\Services\MerekService;
use Illuminate\Http\Request;

class Merek extends Controller
{
    private MerekService $merekService;

    public function __construct(MerekService $merekService)
    {
        $this->merekService = $merekService;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->merek;
            $result = $this->merekService->create($data);

            if ($result['status'] == 'error') {
                throw new \Exception($result['message']);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $merekId)
    {
        $data = ['nama' => $request->merek];

        try {
            $result = $this->merekService->updateMerek($merekId, $data);

            if ($result['status'] == 'error') {
                throw new \Exception($result['message']);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function delete($merekId)
    {
        try {
            $result = $this->merekService->deleteMerek($merekId);

            if ($result['status'] == 'error') {
                throw new \Exception($result['message']);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
