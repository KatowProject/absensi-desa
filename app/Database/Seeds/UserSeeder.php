<?php

namespace App\Database\Seeds;

use App\Models\Jabatan;
use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $jabatan = new Jabatan();

        $faker = \Faker\Factory::create();

        $jabatans = $jabatan->findAll();

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'role_id' => 2,
                'name' => $faker->name,
                'email' => "user$i@localhost",
                'jabatan_id' => $faker->randomElement($jabatans)['id'],
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
            ];

            $user->insert($data);
        }
    }
}
