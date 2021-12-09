<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class TaskSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
            $this->db->table('task')->insert($this->createTask());
        }
    }

    private function createTask(): array {
        $faker = Factory::create();
        return [
            'text' => $faker->sentence(9),
        ];
    }
}
