<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
	public function up()
	{
		// Create Setting Table
		$this->forge->addField([
			'setting_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'setting_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'setting_value'       => [
				'type'           => 'TEXT',
			],
		]);
		$this->forge->addKey('setting_id', true);
		$this->forge->createTable('setting');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Setting
		$this->forge->dropTable('setting');
	}
}
