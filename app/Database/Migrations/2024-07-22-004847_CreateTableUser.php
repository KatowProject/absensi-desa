<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'jabatan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'],
                'default' => 'L',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('role_id', 'role', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jabatan_id', 'jabatan', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('user');

        $data = [
            [
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@localhost',
                'jabatan_id' => 1,
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 2,
                'name' => 'User',
                'email' => 'user@localhost',
                'jabatan_id' => 2,
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }

    public function down()
    {
        //
    }
}
