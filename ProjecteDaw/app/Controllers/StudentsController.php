<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Models\StudentModel;
use App\Libraries\UUID;

class StudentsController extends BaseController
{
    public function viewStudents()
    {
        $crud = new KpaCrud();
        $data['add'] = true;
        $crud->setTable('students');
        $crud->setPrimaryKey('student_id');
        $crud->setColumns(['student_id', 'email']);
        $crud->setColumnsInfo([
            'student_id' => [
                'name' => 'id estudiant',
            ],
            'email' => [
                'name' => 'email',
            ],
        ]);
        $crud->addItemLink('update', 'fa-solid fa-pen', base_url('/updateStudent'), 'actualitzar estudiant');
        $crud->addItemLink('delete', 'fa fa-trash-o', base_url('/delStudent'), 'eliminar estudiant');
        $crud->setConfig('ssttView');
        $crud->addWhere('student_center_id', session()->get('idCenter'));
        $data['output'] = $crud->render();
        return view('authentication/register/students/viewStudents', $data);
    }

    public function addStudent()
    {
        return view('authentication/register/students/addStudent');
    }

    public function addStudent_post()
    {
        $validationRules = [
            'mail' => [
                'label'  => 'eMail usuari',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                    'valid_email' => 'No és un mail valid',
                ],
            ],
        ];
        if ($this->validate($validationRules)) {
            $instanceSt = new StudentModel();
            $data = [
                'student_id' => UUID::v4(),
                'email' => $this->request->getPost('mail'),
                'student_center_id' => session()->idCenter,
                'language' => 'ca'
            ];
            $instanceSt->insert($data);
            session()->setFlashdata('success', 'alumne afegit correctament');
            return redirect()->to(base_url('validateStudents'));
        } else {
            session()->setFlashdata('error', 'Failed');
            return redirect()->back()->withInput();
        }
    }

    public function updateStudent($id)
    {
        $instanceSt = new StudentModel();
        $st = $instanceSt->obtainStById($id);
        $data['st'] = $st;
        return view('authentication/register/students/updateStudent', $data);
    }

    public function updateStudent_post($id)
    {
        $validationRules = [
            'mail' => [
                'label'  => 'eMail usuari',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                    'valid_email' => 'No és un mail valid',
                ],
            ],
        ];
        if ($this->validate($validationRules)) {
            $instanceSt = new StudentModel();
            $data = [
                'email' => $this->request->getPost('mail'),
            ];
            $valid = $instanceSt->updateSt($id, $data);
            if ($valid == false) {
                session()->setFlashdata('error', 'error, email duplicat');
                return redirect()->back();
            } else {
                session()->setFlashdata('success', 'email modificat correctament');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'error, email no valid');
            return redirect()->back()->withInput();
        }
    }

    public function delStudent($id)
    {
        /*$instanceSt = new StudentModel();
        $instanceSt->deleteStudent($id); */
        return redirect()->back(); 
    }
}
