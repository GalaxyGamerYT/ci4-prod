<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFavouritesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'favourite_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'site_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'favourited_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('favourite_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('site_id', 'sites', 'site_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('favourites');
    }

    public function down()
    {
        $this->forge->dropTable('favourites');
    }
}
