<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Content extends Migration
{
	public function up()
	{
		// Create Content Table
		$this->forge->addField([
			'content_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
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
			'content_type'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_template'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_lang'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_body'       => [
				'type'           => 'TEXT',
			],
			'content_excerpt'       => [
				'type'           => 'TEXT',
			],
			'content_image'       => [
				'type'           => 'TEXT',
			],
			'content_meta_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_meta_desc'       => [
				'type'           => 'TEXT',
			],
			'content_parent'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'content_order'   => [
				'type'          => 'INT',
				'constraint' 	=> 11,
			],
			'content_target'   => [
				'type'          => 'VARCHAR',
				'constraint' 	=> '255',
			],
			'content_publish_date'   => [
				'type'          => 'DATE',
			],
			'content_tags'   => [
				'type'          => 'VARCHAR',
				'constraint'	=> '255',
			],
			'content_options'   => [
				'type'          => 'LONGTEXT',
			],
			'content_status'   => [
				'type'          => 'VARCHAR',
				'constraint' 	=> '255',
			],
		]);
		$this->forge->addKey('content_id', true);
		$this->forge->createTable('content');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Content
		$this->forge->dropTable('content');
	}
}
