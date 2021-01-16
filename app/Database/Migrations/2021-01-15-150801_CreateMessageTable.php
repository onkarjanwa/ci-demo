<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessageTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'text' => [
				'type' => 'LONGTEXT',
			],
			'subject_id' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'status' => [
				'type' => 'ENUM',
				'constraint' => ['active', 'deleted'],
                'default' => 'active',
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('messages');
	}

	public function down()
	{
		$this->forge->dropTable('messages');
	}
}
