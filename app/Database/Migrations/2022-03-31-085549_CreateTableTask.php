<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTask extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'text'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => false,
            ],
            'done'      => [
                'type'           => 'TINYINT',
                'constraint'     => '1',
            ],
            'order'     => [
                'type'           => 'BIGINT',
                'constraint'     => '11',
            ],
            'user_id'   => [
                'type'          => 'int', 
                'constraint'    => 11, 
                'unsigned'      => true,
            ],
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('task');
    }

    public function down()
    {
        $this->forge->dropTable('task');
    }
}
