<?php

namespace Database\Seeders;

use App\Models\Merek;
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
      'nama' => 'ABC1',
    ]);

    Produk::create([
      'merek_id' => 1,
      'nama' => 'test'
    ]);

    Merek::create([
      'nama' => 'tessss'
    ]);
  }
}
