<?php

namespace App\Http\Services;

use App\Repositories\MitraRepo;

class MitraService
{
    private MitraRepo $mitraRepo;

    public function __construct(MitraRepo $mitraRepo)
    {
        $this->mitraRepo = $mitraRepo;
    }

    public function fetchAll()
    {
        return $this->mitraRepo->fetch();
    }

    public function create(array $data)
    {
        try {
            return $this->mitraRepo->create($data);
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $response = $this->mitraRepo->update($id, $data[0]);

            if ($response['status'] == 'error') {
                throw new \Exception($response['message']);
            }

            return $response;
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function deleteMitra(int $id)
    {
        return $this->mitraRepo->delete($id);
    }
}
