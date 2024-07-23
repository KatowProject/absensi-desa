<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableRole extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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

        $this->forge->createTable('role');

        $data = [
            [
                'name' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'User',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('role')->insertBatch($data);

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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

        $this->forge->createTable('jabatan');

        $data = [
            [
                'name' => 'Kepala Desa',
            ],
            [
                'name' => 'Sek-Des',
            ],
            [
                'name' => 'Kasi Pemerintahan',
            ],
            [
                'name' => 'Kasi Pelayanan',
            ],
            [
                'name' => 'Kasi Kesra'
            ],
            [
                'name' => 'Kaur Keuangan',
            ],
            [
                'name' => 'Kaur Perencanaan',
            ],
            [
                'name' => 'Kaur Umum',
            ],
            [
                'name' => 'Operator'
            ],
            [
                'name' => 'Staf Kasi Pemerintahan'
            ],
            [
                'name' => 'Staf Kasi Pelayanan'
            ],
            [
                'name' => 'Staf Kasi Kesra'
            ],
            [
                'name' => 'Staf Kaur Keuangan'
            ],
            [
                'name' => 'Staf Kaur Perencanaan'
            ],
            [
                'name' => 'Staf Kaur Umum'
            ],
            [
                'name' => 'Kadus I'
            ],
            [
                'name' => 'Kadus II'
            ],
            [
                'name' => 'Kadus III'
            ],
            [
                'name' => 'Staf Kadus I'
            ],
            [
                'name' => 'Staf Kadus II'
            ],
            [
                'name' => 'Staf Kadus III'
            ]
        ];

        $this->db->table('jabatan')->insertBatch($data);
    }

    public function down()
    {
        //
    }
}
