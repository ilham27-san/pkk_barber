<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactsTableSafe extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // Cek apakah tabel sudah ada
        if (! $db->tableExists('contacts')) {
            $forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '50',
                    'null'       => false,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null'       => false,
                ],
                'phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '20',
                    'null'       => false,
                ],
                'message' => [
                    'type' => 'TEXT',
                    'null' => false,
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
            ]);

            $forge->addKey('id', true);
            $forge->createTable('contacts');
        } else {
            // Contoh menambahkan kolom baru jika belum ada
            if (! $db->fieldExists('status', 'contacts')) {
                $forge->addColumn('contacts', [
                    'status' => [
                        'type'       => 'VARCHAR',
                        'constraint' => '20',
                        'default'    => 'new',
                        'null'       => false,
                    ]
                ]);
            }
        }
    }

    public function down()
    {
        // Hati-hati, ini akan menghapus tabel
        // $this->forge->dropTable('contacts', true);
    }
}
