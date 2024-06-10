<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionTypeModel;
use App\Libraries\UUID;
use App\Models\InterventionModel;

class InterventionsController extends BaseController
{
<<<<<<< Updated upstream
    public function addIntervention($ticketId) {
        // falta passar-li els professor i alumnes filtrats per instituts o classe ??
        session()->setFlashdata('idTicket',$ticketId);
        $instanceIT = new InterventionTypeModel();
=======
    public function addIntervention($ticketId)
    {
        $instanceIT = new InterventionTypeModel();
        $instanceST = new StockModel();
        $items = $instanceST->checkStockOfCenterAvailable(session()->get('idCenter'));
        // falta passar-li els professor i alumnes filtrats per instituts o classe ??
        session()->setFlashdata('idTicket', $ticketId);

>>>>>>> Stashed changes
        $data = [
            'interTypes' => $instanceIT->getAllInterTypes(),
            'title' => lang('ticketsLang.titleG'),
        ];

        return view('Project/Interventions/addIntervention', $data);
    }

<<<<<<< Updated upstream
    public function addIntervention_post() {
        $instanceI = new InterventionModel();
        $uuid = new UUID();
        //validation important
        //data
        $data = [
            'intervention_id' => $uuid::v4(),
            'ticket_id' => session()->getFlashdata("idTicket"),
            'professor_id' => $this->request->getPost('professor'),
            'student_id' => $this->request->getPost('student'),
            'intervention_type_id' => $this->request->getPost('interventionType'),
            'description' => $this->request->getPost('description'),
            'student_course' => $this->request->getPost('cicle'),
            'student_studies' => $this->request->getPost('course'),
        ];
        $instanceI->insert($data);
    }

    //falta
    public function updateIntervention($ticket) {
        session()->setFlashdata('idTicket',$ticket);
=======
    public function addIntervention_post()
    {
        $validationRules = [
            'interventionType' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'cicle' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'course' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
        ];
        if ($this->validate($validationRules)) {
            $instanceI = new InterventionModel();
            $instanceST = new StockModel();
            $instanceT = new TicketModel();
            $uuid = new UUID();
            //validation important
            $intervention_id = $uuid::v4();
            //check user 
            $idProfessor = null;
            $idStudent = null;
            if (session()->get('role') == "Professor" || session()->get('role') == "Center") {
                $idProfessor = session()->get('id');
            } else {
                $idStudent = session()->get('id');
            }
            //data
            $data = [
                'intervention_id' => $intervention_id,
                'ticket_id' => session()->getFlashdata("idTicket"),
                'professor_id' => $idProfessor,
                'student_id' => $idStudent,
                'intervention_type_id' => $this->request->getPost('interventionType'),
                'description' => $this->request->getPost('description'),
                'student_course' => $this->request->getPost('course'),
                'student_studies' => $this->request->getPost('cicle'),
            ];
            //var_dump($data);
            //die;
            $instanceI->insert($data);
            //stock
            $id = $this->request->getPost('stock');
            $data = [
                'intervention_id' => $intervention_id,
            ];
            $instanceST->update($id, $data);
            //estat tickets
            $data = [
                "status_id" => 2,
            ];
            $instanceT->update(session()->getFlashdata("idTicket"), $data);
            session()->setFlashdata('success', lang('ticketsLang.successAdd'));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('error', lang('ticketsLang.error'));
            return redirect()->back()->withInput();
        }
    }

    //falta
    public function updateIntervention($idInter)
    {
        $instanceI = new InterventionModel();
        $instanceIT = new InterventionTypeModel();
        $instanceS = new StockModel();
        $inter = $instanceI->getSpecificIntervention($idInter);
        $items = $instanceS->checkStockOfCenterAvailable(session()->get('idCenter'));
        $stock = $instanceS->checkStockOfIntervention($idInter);
        if (session()->get('role') == "Student") {
            if ($inter['student_id'] != session()->get('id')) {
                session()->setFlashdata('error', lang('ticketsLang.errorStudent'));
                return redirect()->back()->withInput();
            }
        }
        $block = false;
        $stockNull = false;
        if ($stock != null) {
            if ($stock['intervention_id'] == null) {
                $block = true;
            }
        } else {
            $stockNull = true;
        }
>>>>>>> Stashed changes
        $data = [
            'title' => lang('ticketsLang.titleG'),
        ];
        return view('Project/interventions/updateIntervention', $data);
    }


<<<<<<< Updated upstream
    //falta
    public function updateIntervention_post() {

    }

    //falta
    public function delIntervention($ticket) {
       
=======
    public function updateIntervention_post($idInter)
    {
        $validationRules = [
            'interventionType' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'cicle' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'course' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
        ];
        if ($this->validate($validationRules)) {
            $instanceI = new InterventionModel();
            $instanceST = new StockModel();
            $instanceT = new TicketModel();
            $uuid = new UUID();
            //validation important
            //check user 
            $idProfessor = null;
            $idStudent = null;
            if (session()->get('role') == "Professor" || session()->get('role') == "Center") {
                $idProfessor = session()->get('id');
            } else {
                $idStudent = session()->get('id');
            }
            //data
            $data = [
                'professor_id' => $idProfessor,
                'student_id' => $idStudent,
                'intervention_type_id' => $this->request->getPost('interventionType'),
                'description' => $this->request->getPost('description'),
                'student_course' => $this->request->getPost('course'),
                'student_studies' => $this->request->getPost('cicle'),
            ];
            $instanceI->update($idInter, $data);
            //stock
            $id = $this->request->getPost('stock');
            $stock = $instanceST->checkStockOfIntervention($idInter);
            if ($id ==  null && $stock != null) {
                $stock['intervention_id'] = null;
                $instanceST->update($stock['stock_id'], $stock);
            }
            $data = [
                'intervention_id' => $idInter,
            ];
            $instanceST->update($id, $data);
            session()->setFlashdata('success', lang('ticketsLang.successUpdate'));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('error', lang('ticketsLang.error'));
            return redirect()->back()->withInput();
        }
    }

    public function delIntervention($id)
    {
        // fet i validat 
        $instanceI = new InterventionModel();
        $instanceI->deleteIntervention($id);
        session()->setFlashdata('success', lang('ticketsLang.successDelete'));
        return redirect()->back()->withInput();
>>>>>>> Stashed changes
    }
}
