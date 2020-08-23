<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Widget extends Migration
{
	public function up()
	{
		// Create Widget Table
		$this->forge->addField([
			'widget_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'widget_position'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'widget_order'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'widget_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'widget_value'       => [
				'type'           => 'LONGTEXT',
			],
		]);
		$this->forge->addKey('widget_id', true);
		$this->forge->createTable('widget');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Widget
		$this->forge->dropTable('widget');
	}
}
