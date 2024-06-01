<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\StatusModel;

class TicketsInterventionsController extends BaseController
{
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function viewIntermediary($id)
    {
        //calls
        $instanceT = new TicketModel();
        $status = new StatusModel();
        //functions
        $ticket = $instanceT->retrieveSpecificData($id);
        //kpaCrud
        $crud = new KpaCrud();
        $crud->setTable('interventions');
        $crud->setPrimaryKey('intervention_id');
        $crud->setRelation('intervention_type_id', 'interventionType', 'intervention_type_id', 'intervention_type');
        $crud->setColumns(['description', 'interventionType__intervention_type', 'created_at']);
        $crud->setColumnsInfo([
            'description' => ['name' => 'descripció'],
            'interventionType__intervention_type' => ['name' => 'Tipus intervenció'],
            'created_at' => ['name' => 'Data creació'],
        ]);
        $crud->setConfig('ssttView');  
        $crud->addWhere('ticket_id', $id);
        //obtenim ticket especific
        $add = true;
        if (session()->get('role') == "Student" || session()->get('role') == "Professor" || session()->get('role') == "Center") {
            if ($ticket['status_id'] <= 2 ) {
                $crud->addItemLink('view', 'fa-solid fa-pen', base_url('/updateIntervention'), 'Modificar Intervencio');
                if ($ticket['status_id'] == 1) {
                    $crud->addItemLink('del', 'fa fa-trash-o', base_url('/delIntervention'), 'Eliminar Intervencio');
                }
            } else {
                $add = false;
            }
        }
        // mostreem o no el boto de afegir
        if (session()->get('role') == "SSTT") {
            $add = false;
        }
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
            'ticket' => $ticket,
            'status' => $status->getStatus($ticket['status_id']),
            'add' => $add,
        ];
        return view('Project/intermediaryTicInter/intermediary', $data);
    }
}
