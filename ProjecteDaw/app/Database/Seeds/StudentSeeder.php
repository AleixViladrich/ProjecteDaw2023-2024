<?php

namespace App\Database\Seeds;

use App\Models\StudentModel;
use CodeIgniter\Database\Seeder;
use App\Libraries\UUID;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $model = new StudentModel();

        $model->insert([
            'student_id' => UUID::v4(),
            'email' => "faixala@inscaparrella.cat",
            'student_center_id' => "8000013",
            'language' => 'ca'
        ]);
    }
}
