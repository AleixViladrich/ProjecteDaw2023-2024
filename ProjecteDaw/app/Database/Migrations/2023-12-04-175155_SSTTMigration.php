<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTTMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'SSTT_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '4',
                    'auto_increment' => true,
                    'null'           => false,
            ],
            'name'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128',
                    'null'           => false,
            ],
            'address'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128',
                    'null'           => false,
            ],
            'phone'          => [
                    'type'           => 'INT',
                    'constraint'     => 9,
            ],
            'email'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
                    'null'           => false,
            ],
        ]);
        $this->forge->addKey('SSTT_id', true);
        $this->forge->createTable('SSTT');
    }

    public function down()
    {
        $this->forge->droptable('SSTT');
    }
}
