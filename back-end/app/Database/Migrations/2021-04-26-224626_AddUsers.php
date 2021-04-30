<?php

namespace App\Database\Migrations;

use App\Models\User;
use CodeIgniter\Database\Migration;

class AddUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at "timestamp" default now()',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');

        $user = new User();
        $user->save([
            'name' => 'User Test',
            'email' => 'test@test.com',
            'password' => '12345678'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
