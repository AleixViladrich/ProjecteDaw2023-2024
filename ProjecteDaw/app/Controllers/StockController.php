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
        $crud->setColumns(['stock_id', 'stocktype__name', 'interdescription', 'purchase_date', 'price']);
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
            'interdescription' => [
                'name' => lang('stockLang.intervention'),
            ],
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
        $crud->addWhere("center_id", session()->get('idCenter'));
        $crud->setConfig('ssttView');
        //$crud->addWhere('center_id', session()->get('idCenter'));
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
            $center = session()->get('idCenter');
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
            session()->setFlashdata("enabled", "true");
        } else {
            //tiquet no assignat
            session()->setFlashdata("enabled", "false");
        }
        return view('Project/stock/updateStock', $data);
    }

    public function updateStock_post($id)
    {
        $enabled = session()->getFlashdata('enabled');
        if ($enabled == "true") {
            $validationRules = [
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
            ];
        } else {
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
