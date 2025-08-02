<?php

namespace Database\Seeders;

use App\Models\Merek;
use App\Models\Mitra;
use App\Models\Produk;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    Role::create([
      'name' => 'Admin',
    ]);

    Role::create([
      'name' => 'Karyawan',
    ]);

    User::create([
      'username' => 'nusalendra',
      'password' => bcrypt('password'),
      'role_id' => '1'
    ]);

    User::create([
      'username' => 'laskarpelangi',
      'password' => bcrypt('password'),
      'role_id' => '2'
    ]);

    Merek::create([
      'nama' => 'PRO7',
    ]);

    Merek::create([
      'nama' => 'UPS',
    ]);

    Merek::create([
      'nama' => 'BEEBOOT',
    ]);

    Mitra::create([
      'badan_usaha' => 'CV',
      'nama' => 'CV. Cinta',
      'email' => 'budisetyo@gmail.com',
      'nomor_telepon' => '089677888764'
    ]);
  }
}
