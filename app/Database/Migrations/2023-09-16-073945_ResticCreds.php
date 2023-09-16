<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResticCreds extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'b2_account_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'b2_account_key' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'b2_account_pass_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('restic_creds');
    }

    public function down()
    {
        $this->forge->dropTable('restic_creds');
    }
}
