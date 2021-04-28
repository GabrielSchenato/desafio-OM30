<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPatients extends Migration
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
				'constraint' => '255',
				'null' => false
			],
			'image' => [
				'type' => 'TEXT',
				'null' => true
			],
			'mothers_name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'birthday' => [
				'type' => 'date',
				'null' => false
			],
			'cpf' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
				'unique' => true
			],
			'cns' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
				'unique' => true
			],
			'cep' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'street' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'complement' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
			'district' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'locality' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false
			],
			'uf' => [
				'type' => 'VARCHAR',
				'constraint' => '2',
				'null' => false
			],
			'updated_at' => [
				'type' => 'datetime',
				'null' => true,
			],
			'created_at "timestamp" default now()',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('patients');
	}

	public function down()
	{
		$this->forge->dropTable('patients');
	}
}
