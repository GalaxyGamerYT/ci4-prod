<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPrivilegesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'privilege_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => True,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'editable' => [
                'type' => 'BOOL',
                'default' => 1,
            ],
            'admin' => [
                'type' => 'BOOL',
                'default' => 0,
            ],
        ]);
        $this->forge->addPrimaryKey('privilege_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('privileges');
    }

    public function down()
    {
        $this->forge->dropTable('privileges');
    }
}
