<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idRole' => [
                'type' => 'INT',
                'constraint' => '16',
                'auto_increment' => true, 
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
            ]
        ]);

        $this->forge->addKey('idRole', true);
        $this->forge->createTable('roles');

        $this->forge->addField([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('email', true);
        $this->forge->createTable('logins');


        $this->forge->addField([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
            ],
            'idRole' => [
                'type' => 'INT',
                'constraint' => '16',
            ],
        ]);
        $this->forge->addPrimaryKey(['email', 'idRole']);
        $this->forge->addForeignKey('email', 'logins', 'email', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('idRole', 'roles', 'idRole', 'CASCADE', 'CASCADE'); 
        $this->forge->createTable('usersinrole');
    }

    public function down()
    {
        $this->forge->dropTable('usersinrole', true);
        $this->forge->dropTable('logins', true);
        $this->forge->dropTable('roles', true);
    }
}
