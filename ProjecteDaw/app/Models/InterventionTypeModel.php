<?php

namespace App\Models;

use CodeIgniter\Model;

class InterventionTypeModel extends Model
{
    protected $table            = 'interventionType';
    protected $primaryKey       = 'intervention_type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['intervention_type_id','intervention_type'];

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

    public function getAllInterTypes() {
        $interTypeArr = $this->select('intervention_type')->findAll();

        $interString = [];

        foreach ($interTypeArr as $dataLoop) {
            $interString[] = $dataLoop['intervention_type'];
        }

        return $interString;
    }

}
