<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentMeta extends Migration
{
	public function up()
	{
		// Create Content Meta Table
		$this->forge->addField([
			'content_meta_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'content_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'content_meta_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'content_meta_value'       => [
				'type'           => 'LONGTEXT',
			],
		]);
		$this->forge->addKey('content_meta_id', true);
		$this->forge->createTable('content_meta');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// Drop Table Content Meta
		$this->forge->dropTable('content_meta');
	}
}
