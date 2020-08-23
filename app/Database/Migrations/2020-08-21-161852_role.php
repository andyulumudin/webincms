<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
	public function up()
	{
		// Create Role Table
		$this->forge->addField([
			'role_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'created_at'       => [
				'type'           => 'DATETIME',
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
			],
			'role_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'role_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'role_url'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'role_description'       => [
				'type'           => 'TEXT',
			],
			'role_image'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'role_parent'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'role_status'   => [
				'type'          => 'VARCHAR',
				'constraint' 	=> '255',
			],
		]);
		$this->forge->addKey('role_id', true);
		$this->forge->createTable('role');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Role
		$this->forge->dropTable('role');
	}
}
