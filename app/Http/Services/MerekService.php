<?php

namespace App\Http\Services;

use App\Repositories\MerekRepo;

class MerekService
{
    private MerekRepo $merekRepo;

    public function __construct(MerekRepo $merekRepo)
    {
        $this->merekRepo = $merekRepo;
    }

    public function fetchAll()
    {
        return $this->merekRepo->fetch();
    }

    public function create(array $data)
    {
        try {
            $results = [];
            foreach ($data as $merk) {
                $results[] = $this->merekRepo->create(['nama' => $merk]);
            }

            return [
                'status' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function updateMerek(int $id, array $data)
    {
        try {
            if (empty($id)) {
                throw new \Exception("ID merek not found");
            }

            $update = $this->merekRepo->update($id, $data);

            return [
                'status' => 'success'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function deleteMerek(int $id)
    {
        try {
            if (empty($id)) {
                throw new \Exception("Id merek tidak ditemukan");
            }

            $result = $this->merekRepo->delete($id);

            if ($result->getStatusCode() !== 200) {
                $response = json_decode($result->getContent(), true);
                throw new \Exception($response['message'] ?? 'Terjadi kesalahan saat menghapus merek');
            }

            return [
                'status' => 'success'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }
}
