<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPreferencesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'preference_id' => [
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
            'theme_mode' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => '2',
            ],
        ]);
        $this->forge->addPrimaryKey('preference_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('preferences');
    }

    public function down()
    {
        $this->forge->dropTable('preferences');
    }
}
