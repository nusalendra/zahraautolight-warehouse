<?php

namespace App\Dtos;

class MItraDto
{
    public string $badan_usaha;
    public string $nama;
    public string $email;
    public string $nomor_telepon;
    public array $data;

    public static function fromRequest($request): self
    {
        $dto = new self();

        $dto->badan_usaha = $request->badan_usaha;
        $dto->nama = $request->nama;
        $dto->email = $request->email;
        $dto->nomor_telepon = $request->nomor_telepon;

        $dto->data[] = [
            'badan_usaha' => $dto->badan_usaha,
            'nama' => $dto->nama,
            'email' => $dto->email,
            'nomor_telepon' => $dto->nomor_telepon,
            'created_at' => now(),
            'updated_at' => now()
        ];

        return $dto;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
