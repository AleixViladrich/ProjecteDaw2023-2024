<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\CenterModel;
use App\Models\StockModel;
use App\Models\StockTypeModel;
use Google\Service\CloudRedis\RedisEmpty;

class StockController extends BaseController
{
    public function viewStock()
    {
        helper('lang');
        $crud = new KpaCrud();
        /**
         * Retorno true o false depent de la pag on estem, per mostrar o no el boto de add ticket
         */
        if ($crud->isEditMode()) {
            $data['badd'] = false;
        } else {
            $data['badd'] = true;
        }
        $crud->setTable('stockview');
        $crud->setPrimaryKey('stock_id');
        $crud->setRelation('stock_type_id', 'stocktype', 'stock_type_id', 'name');
<<<<<<< Updated upstream
        $crud->setRelation('center_id', 'centers', 'center_id', 'name');
        $crud->setColumns(['stock_id', 'stocktype__name', 'intervention_id', 'centers__name', 'purchase_date', 'price']);
=======
        $crud->setColumns(['stock_id', 'stocktype__name', 'interdescription', 'purchase_date', 'price']);
>>>>>>> Stashed changes
        $crud->setColumnsInfo([
            'stock_id' => [
                'name' => lang('stockLang.id'),
                'type' => KpaCrud::READONLY_FIELD_TYPE,
                'default' => UUID::v4(),
                'html_atts' => [
                    'disabled'
                ]
            ],
            'stocktype__name' => [
                'name' => lang('stockLang.name'),
            ],
<<<<<<< Updated upstream
            'intervention_id' => [
                'name' => 'Intervencio assignada'
            ],
=======
            'interdescription' => [
                'name' => lang('stockLang.intervention'),
            ],/*
>>>>>>> Stashed changes
            'centers__name' => [
                'name' => 'centre del stock',
            ],
            'purchase_date' => [
                'name' => lang('stockLang.purchaseDate'),
            ],
            'price' => [
                'name' => lang('stockLang.priceUnit'),
            ],
        ]);
        $crud->addItemLink('updateStock', 'fa-solid fa-pen', base_url('updateStock'), 'Update stock');
        $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/delStock'), 'Eliminar stock');
<<<<<<< Updated upstream

        $crud->setConfig('ssttView');
=======
        $crud->addWhere("center_id", session()->get('idCenter'));
        $crud->setConfig('ssttView');
        //$crud->addWhere('center_id', session()->get('idCenter'));
>>>>>>> Stashed changes
        $data['output'] = $crud->render();
        

        return view('Project/stock/viewStock', $data);
    }

    public function addStock()
    {
        $instanceST = new StockTypeModel();
        $instanceC = new CenterModel();
        $data['types'] = $instanceST->retrieveAllTypes();
        $data['center'] =  $instanceC->getAllCentersId();
        return view('Project/stock/createStock', $data);
    }

    public function addStock_post()
    {
        $validationRules = [
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'type_piece' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'center' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'number_units' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
        ];
        //validation
        if ($this->validate($validationRules)) {
            $instanceS = new StockModel();
            $description = $this->request->getPost('description');
            $typePiece = $this->request->getPost('type_piece');
            $price = $this->request->getPost('price');
            $center = $this->request->getPost('center');
            $numberItems = $this->request->getPost('number_units');
            if ($numberItems <= 0) {
                $numberItems = 1;
            }
            for ($i = 0; $i < $numberItems; $i++) {
                $instanceS->addStock($description, $typePiece, $center, $price);
            }
            session()->setFlashdata('success', lang('stockLang.successAdd'));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('error', lang('stockLang.error'));
            return redirect()->back()->withInput();
        }
    }

    public function updateStock($id)
    {
        $instance = new StockModel();
        $instanceST = new StockTypeModel();
        $instanceC = new CenterModel();
        $updateLevel = $instance->checkIfInterventionAssigned($id);
        //el stock en especific
        $data['stock'] = $instance->retrieveSpecificItem($id);
        // types
        $data['types'] = $instanceST->retrieveAllTypes();
        //center
        $data['center'] =  $instanceC->getAllCentersId();
        if ($updateLevel == true) {
            //tiquet assignat
<<<<<<< Updated upstream
            session()->setFlashdata("level", 1);
        } else {
            //tiquet no assignat
            session()->setFlashdata("level", 0);
=======
            session()->setFlashdata("enabled", "true");
        } else {
            //tiquet no assignat
            session()->setFlashdata("enabled", "false");
>>>>>>> Stashed changes
        }
        return view('Project/stock/updateStock', $data);
    }

    public function updateStock_post($id)
    {
<<<<<<< Updated upstream
        if (session()->getFlashdata("level") == 1) {

        }
        if (session()->getFlashdata("level") == 0) {
            $validationRules = [
                'description' => [
=======
        $enabled = session()->getFlashdata('enabled');
        if ($enabled == "true") {
            $validationRules = [
                'price' => [
>>>>>>> Stashed changes
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
<<<<<<< Updated upstream
                'type_piece' => [
=======
            ];
        } else {
            $validationRules = [
                'description' => [
>>>>>>> Stashed changes
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
<<<<<<< Updated upstream
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'center' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'number_units' => [
=======
                'type_piece' => [
>>>>>>> Stashed changes
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
<<<<<<< Updated upstream
            ];
            //validation
            if ($this->validate($validationRules)) {
                $instanceS = new StockModel();
                $description = $this->request->getPost('description');
                $typePiece = $this->request->getPost('type_piece');
                $price = $this->request->getPost('price');
                $center = $this->request->getPost('center');
                $numberItems = $this->request->getPost('number_units');
                if ($numberItems <= 0) {
                    $numberItems = 1;
                }
                for ($i = 0; $i < $numberItems; $i++) {
                    $instanceS->addStock($description, $typePiece, $center, $price);
                }
            } else {
                session()->setFlashdata('error', 'dades insuficients');
                return redirect()->back()->withInput();
            }
=======
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
            ];
        }
        //validation
        if ($this->validate($validationRules)) {
            $instanceS = new StockModel();
            $description = $this->request->getPost('description');
            $typePiece = $this->request->getPost('type_piece');
            $price = $this->request->getPost('price');
            if ($enabled == "true") {
                $data = [
                    'price' => $price,
                ];
            } else {
                $data = [
                    'stock_type_id' => $typePiece,
                    'description' => $description,
                    'price' => $price,
                ]; 
            }
            $instanceS->update($id, $data);
            session()->setFlashdata('success', lang('stockLang.successUpdate'));
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('error', lang('stockLang.error'));
            return redirect()->back()->withInput();
>>>>>>> Stashed changes
        }
        return redirect()->back()->withInput();
    }

    public function deleteStock($stock)
    {
        $instanceS = new StockModel();
        $item = $instanceS->retrieveSpecificItem($stock);
        if ($item['intervention_id'] != null) {
            session()->setFlashdata('error', lang('StockLang.errorDelete'));
            return redirect()->back();
        }
        //fe soft delete
        session()->setFlashdata('success', lang('stockLang.successDelete'));
        $instanceS->delete($stock);
        return redirect()->back();
    }
}
