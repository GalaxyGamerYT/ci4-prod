<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSitesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'site_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'site_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'site_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'added_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('site_id');
        $this->forge->createTable('sites');
    }

    public function down()
    {
        $this->forge->dropTable('sites');
    }
}
