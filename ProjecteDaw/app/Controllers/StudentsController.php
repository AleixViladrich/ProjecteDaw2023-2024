<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Models\StudentModel;
use App\Libraries\UUID;
use App\Models\LoginsModel;
use App\Models\UsersInRoleModel;

class StudentsController extends BaseController
{
    public function viewStudents()
    {
        $crud = new KpaCrud();
        $data['add'] = true;
        $crud->setTable('students');
        $crud->setPrimaryKey('student_id');
        $crud->setColumns(['email','created_at','updated_at']);
        $crud->setColumnsInfo([
            'email' => [
                'name' => lang('studentsLang.email_student'),
            ],
            'created_at' => [
                'name' => lang('studentsLang.createDate'),
            ],
            'updated_at' => [
                'name' => lang('studentsLang.updateDate'),
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
            'pass' => [
                'label'  => 'eMail usuari',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                ],
            ]
        ];
        if ($this->validate($validationRules)) {
            //models
            $instanceSt = new StudentModel();
            $instanceL = new LoginsModel();
            $instanceUIR = new UsersInRoleModel();
            //data
            $mail = $this->request->getPost('mail');
            $pass = $this->request->getPost('pass');
            $data = [
                'student_id' => UUID::v4(),
                'email' => $mail,
                'student_center_id' => session()->get('idCenter'),
                'language' => 'ca',
            ];
            $instanceSt->insert($data);
            $instanceL->addUser($mail, password_hash((string)$pass, PASSWORD_DEFAULT));
            $instanceUIR->addStudent($mail);
            session()->setFlashdata('success', lang('studentsLang.successAdd'));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('error', lang('studentsLang.error'));
            return redirect()->back()->withInput();
        }
    }

    public function updateStudent($id)
    {
        $instanceSt = new StudentModel();
        $st = $instanceSt->obtainStById($id);
        $data['st'] = $st;
        session()->setFlashdata('oldMail',$st['email']);
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
            $instanceL = new LoginsModel ();
            $instanceUIR = new UsersInRoleModel();
            $mail = $this->request->getPost('mail');
            $pass = $this->request->getPost('pass');
            $check = $this->request->getPost('allow');
            $oldMail = session()->getFlashdata('oldMail');
            //var_dump($mail, $pass, $check, $oldMail);
            //die;
            if(is_string($pass) && strlen($pass) < 6 && $check == "on") {
                session()->setFlashdata('error', lang('studentsLang.errorMinChar'));
                return redirect()->back();
            }
            $valid = $instanceSt->updateSt($id, $mail);
            if ($valid == false) {
                session()->setFlashdata('error', lang('studentsLang.errorDuplicate'));
                return redirect()->back();
            } else {
                //update de les taules logins i users in role
                $data = [
                    'email' => $mail,
                ];
                //$instanceUIR->updateByEmail($oldMail, $data);
                if ($pass != null) {
                    $data = [
                        'email' => $mail,
                        'password' => password_hash((string)$pass, PASSWORD_DEFAULT),
                    ];
                } else if ($pass == null) {
                    $data = [
                        'email' => $mail,
                    ];
                }
                $instanceL->updateByEmail($oldMail, $data);
                session()->setFlashdata('success', lang('studentsLang.successUpdate'));
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', lang('studentsLang.errorMin'));
            return redirect()->back()->withInput();
        }
    }

    public function delStudent($id)
    {
        $instanceSt = new StudentModel();
        $student = $instanceSt->obtainStById($id);
        $instanceSt->deleteStudent($student);
        session()->setFlashdata('success', lang('studentsLang.successDelete'));
        return redirect()->back();
    }
}
