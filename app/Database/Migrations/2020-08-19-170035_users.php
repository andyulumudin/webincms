<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		// Create Users Table
		$this->forge->addField([
			'user_id'          => [
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
			'user_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_account'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_password' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
		]);
		$this->forge->addKey('user_id', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Users
		$this->forge->dropTable('users');
	}
}
