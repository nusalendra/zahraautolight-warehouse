<?php

namespace App\Http\Controllers\API\User;

use App\Dtos\UserDto;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Illuminate\Http\Request;

class User extends Controller
{
    private UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store(Request $request)
    {
        try {
            $userDto = UserDto::fromRequest($request);
            $result = $this->userRepo->create($userDto->data);

            return [
                'status' => 1
            ];
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $userDto = UserDto::fromRequest($request);
            $result = $this->userRepo->update($id, $userDto->data);

            if ($result['status'] === 'error') {
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

    public function delete($id)
    {
        try {
            $result = $this->userRepo->delete($id);

            if ($result['status'] === 'error') {
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
