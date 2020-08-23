<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
	public function up()
	{
		// Create Menu Table
		$this->forge->addField([
			'menu_id'          => [
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
			'menu_group'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'menu_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'menu_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'menu_slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'menu_description'       => [
				'type'           => 'TEXT',
			],
			'menu_url'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'menu_target'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'menu_image'   => [
				'type'          => 'VARCHAR',
				'constraint' 	=> '255',
			],
			'menu_parent'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'menu_order'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
		]);
		$this->forge->addKey('menu_id', true);
		$this->forge->createTable('menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Menu
		$this->forge->dropTable('menu');
	}
}
