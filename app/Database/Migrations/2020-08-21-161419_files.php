<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Files extends Migration
{
	public function up()
	{
		// Create Files Table
		$this->forge->addField([
			'file_id'          => [
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
			'file_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'file_mime_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'file_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'file_url'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'file_caption'       => [
				'type'           => 'TEXT',
			],
			'file_size'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'file_ext'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'file_image_width'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'file_image_height'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'file_status'   => [
				'type'          => 'VARCHAR',
				'constraint' 	=> '255',
			],
		]);
		$this->forge->addKey('file_id', true);
		$this->forge->createTable('files');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Files
		$this->forge->dropTable('files');
	}
}
