<?php

namespace App\Repositories;

use App\Models\User;

class UserRepo
{
    public function create(array $data)
    {
        return User::insert($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::find($id);
        if (empty($user)) {
            return [
                'status' => 'error',
                'message' => 'User Tidak Ditemukan'
            ];
        }

        $user->update([
            'username' => $data[0]['username'] ?? $user->username,
            'password' => $data[0]['password'] ?? $user->password,
            'role_id' => $data[0]['role_id'] ?? $user->role_id
        ]);

        return [
            'status' => 1
        ];
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return [
                'status' => 'error',
                'message' => 'User Tidak Ditemukan'
            ];
        }

        $user->delete();

        return [
            'status' => 1
        ];
    }
}
