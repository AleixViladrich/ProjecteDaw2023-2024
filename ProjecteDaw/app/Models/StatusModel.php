<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table            = 'status';
    protected $primaryKey       = 'status_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['status_id', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllStatus()
    {
        $status = $this->select('status')->findAll();

        $dataStatus = [];

        foreach ($status as $dataLoop) {
            $dataStatus[] = $dataLoop['status'];
        }

        return $dataStatus;
    }

    public function getStatusSSTT($block) {
        $statuses = $this->findAll();
        $statusArr = [];
        foreach ($statuses as $status) {
            if ($block == true) {
                if ($status['status_id'] == 4) {
                    $statusArr[0] = $status;
                }
            } else {
                if ($status['status_id'] == 3) {
                    $statusArr[0] = $status;
                }
            }
            if ($status['status_id'] == 5) {
                $statusArr[1] = $status;
                
            }
            if ($status['status_id'] == 6) {
                $statusArr[2] = $status;
                
            }
        }
        return $statusArr;

    }

    public function getStatusProf($block) {
        $statuses = $this->findAll();
        $statusArr = [];
        
        foreach ($statuses as $status) {
            if ($status['status_id'] == 2) {
                $statusArr[0] = $status;
                
            }
            if ($block == true) {
                if ($status['status_id'] == 4) {
                    $statusArr[1] = $status;;
                }
            } else {
                if ($status['status_id'] == 3) {
                    $statusArr[1] = $status;
                }
            }
        }
        return $statusArr;
    }

    public function getStatus($id)
    {
        $this->select('status');
        $this->where('status_id', $id);
        $query = $this->get();
        if ($query->getNumRows() > 0) {
            return $query->getResult()[0]->status;
        } else {
            return null;
        }
    }
}
