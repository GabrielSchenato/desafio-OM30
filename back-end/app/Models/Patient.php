<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Patient extends Model
{
    protected $table = 'patients';
    protected $allowedFields = [
        'name',
        'image',
        'mothers_name',
        'birthday',
        'cpf',
        'cns',
        'cep',
        'street',
        'complement',
        'district',
        'locality',
        'uf',
    ];
    protected $updatedField = 'updated_at';

    public function findPatientById($id)
    {
        $patient = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$patient) throw new Exception('Could not find Patient for specified ID');

        return $patient;
    }
}
