<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Kaos Polos',
                'description' => 'Kaos polos berkualitas tinggi',
                'price'       => 50000,
                'image'       => null,
            ],
            [
                'name'        => 'Kemeja Flanel',
                'description' => 'Kemeja flanel keren',
                'price'       => 100000,
                'image'       => null,
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}