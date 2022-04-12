<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class TaskSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 5; $i++){
            $this->db->table('task')->insert($this->createTaskUser1());
            $this->db->table('task')->insert($this->createTaskUser2());
        }
    }

    private function createTaskUser1(): array {
        $faker = Factory::create();
        return [
            'text' => $faker->sentence(9),
            'order' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => 2,
        ];
    }

    private function createTaskUser2(): array {
        $faker = Factory::create();
        return [
            'text' => $faker->sentence(9),
            'order' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => 3,
        ];
    }
}
