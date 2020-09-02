<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoleRelation extends Migration
{
	public function up()
	{
		// Create Role Relation Table
		$this->forge->addField([
			'role_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'object_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'object_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
		]);
		$this->forge->createTable('role_relation');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Role Relation
		$this->forge->dropTable('role_relation');
	}
}
