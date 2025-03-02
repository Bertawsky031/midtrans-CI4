<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_id'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true, // Jika tidak ada sistem user
            ],
            'gross_amount'  => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'status'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'created_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}