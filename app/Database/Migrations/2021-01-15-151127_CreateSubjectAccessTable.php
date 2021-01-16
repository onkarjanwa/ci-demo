<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectAccessTable extends Migration
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
			'subject_id' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'access_type' => [
				'type' => 'ENUM',
				'constraint' => ['admin'],
                'default' => 'admin',
			],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('subject_accesses');
	}

	public function down()
	{
		$this->forge->dropTable('subject_accesses');
	}
}
