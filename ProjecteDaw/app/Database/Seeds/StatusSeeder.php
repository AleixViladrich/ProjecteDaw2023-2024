<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StatusModel;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $model = new StatusModel();

        $model->insert([
            'status' => 'Per reparar'
        ]);
        $model->insert([
            'status' => 'En reparacio'
        ]);
        $model->insert([
            'status' => 'Acabat'
        ]);
        $model->insert([
            'status' => 'bloquejant'
        ]);
    }
}