<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		// Create Blog Table
		$this->forge->addField([
			'users_id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'users_name'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			'users_password' => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
			],
		]);
		$this->forge->addKey('users_id', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Blog
		$this->forge->dropTable('users');
	}
}
