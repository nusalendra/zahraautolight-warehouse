<?php

namespace App\Dtos;

use Illuminate\Http\Request;

class UserDto
{
    public string $username;
    public string $password;
    public int $role_id;
    public array $data;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $username = $request->username;
        $password = $request->password;
        $role_id = $request->role_id;

        $dto->data[] = [
            'username' => $username,
            'password' => bcrypt($password),
            'role_id' => $role_id
        ];

        return $dto;
    }
}
