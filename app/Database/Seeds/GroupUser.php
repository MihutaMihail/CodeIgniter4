<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupUser extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 1; $i++){
            $this->db->table('auth_groups')->insert($this->createGroupAdmin());
            $this->db->table('auth_groups')->insert($this->createGroupUser());
            $this->db->table('auth_groups_users')->insert($this->associateAdminGroup());
            $this->db->table('auth_groups_users')->insert($this->associateUser1Group());
            $this->db->table('auth_groups_users')->insert($this->associateUser2Group());
        }
    }

    private function createGroupAdmin(): array {
        return [
            'name'          => 'Admin',
            'description'   => 'Administrateur du site',
        ];
    }

    private function createGroupUser(): array {
        return [
            'name'          => 'Users',
            'description'   => 'Utilisateur du site',
        ];
    }

    private function associateAdminGroup(): array {
        return [
            'group_id'      => '1',
            'user_id'       => '1',
        ];
    }

    private function associateUser1Group(): array {
        return [
            'group_id'      => '2',
            'user_id'       => '2',
        ];
    }

    private function associateUser2Group(): array {
        return [
            'group_id'      => '2',
            'user_id'       => '3',
        ];
    }
}
