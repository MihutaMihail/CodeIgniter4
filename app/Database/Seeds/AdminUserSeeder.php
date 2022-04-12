<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 1; $i++){
            $this->db->table('users')->insert($this->createAdmin());
            $this->db->table('users')->insert($this->createUser1());
            $this->db->table('users')->insert($this->createUser2());
        }
    }

    private function createAdmin(): array {
        return [
            'email'         => 'admin@gmail.com',
            'username'      => 'admin',
            'password_hash' => \Myth\Auth\Password::hash('siojjradmin'),
            'active'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ];
    }

    private function createUser1(): array {
        return [
            'email'         => 'user1@gmail.com',
            'username'      => 'user1',
            'password_hash' => \Myth\Auth\Password::hash('siojjruser1'),
            'active'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ];
    }

    private function createUser2(): array {
        return [
            'email'         => 'user2@gmail.com',
            'username'      => 'user2',
            'password_hash' => \Myth\Auth\Password::hash('siojjruser2'),
            'active'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ];
    }
}
