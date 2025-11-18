<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactsTableSafe extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // Jika tabel belum ada, buat tabel baru
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
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '20',
                    'default'    => 'new',
                    'null'       => false,
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
            // Jika tabel sudah ada, pastikan kolom yang dibutuhkan ada
            $columns = [
                'name'       => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => false],
                'email'      => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
                'phone'      => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => false],
                'message'    => ['type' => 'TEXT', 'null' => false],
                'status'     => ['type' => 'VARCHAR', 'constraint' => '20', 'default' => 'new', 'null' => false],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ];

            foreach ($columns as $columnName => $definition) {
                if (! $db->fieldExists($columnName, 'contacts')) {
                    $forge->addColumn('contacts', [
                        $columnName => $definition
                    ]);
                }
            }
        }
    }

    public function down()
    {
        // Aman untuk rollback
        $forge = \Config\Database::forge();
        $forge->dropTable('contacts', true);
    }
}
