<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TicketModel;

class TestController extends BaseController
{
    public function index()
    {
        $model = new TicketModel();
        $data['data'] = $model->findAll();
        return view('test', $data);
    }
}
