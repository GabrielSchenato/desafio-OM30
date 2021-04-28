<?php

namespace App\Controllers;

use App\Models\Patient;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Patients extends BaseController
{
    /**
     * Get all patients
     * @return Response
     */
    public function index()
    {
        $model = new Patient();
        return $this->getResponse(
            [
                'message' => 'Patients retrieved successfully',
                'patients' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new patient
     */
    public function store()
    {
        $rules = [
            'name' => 'required',
            'mothers_name' => 'required',
            'birthday' => 'required',
            'cpf' => 'required',
            'cns' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new Patient();
        $id = $model->insert($input);


        $patient = $model->findPatientById($id);

        return $this->getResponse(
            [
                'message' => 'Patient added successfully',
                'patient' => $patient
            ]
        );
    }

    public function update($id)
    {
        try {

            $model = new Patient();
            $model->findPatientById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $patient = $model->findPatientById($id);

            return $this->getResponse(
                [
                    'message' => 'Patient updated successfully',
                    'patient' => $patient
                ]
            );
        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Get a single patient by ID
     */
    public function show($id)
    {
        try {

            $model = new Patient();
            $patient = $model->findPatientById($id);

            return $this->getResponse(
                [
                    'message' => 'Patient retrieved successfully',
                    'patient' => $patient
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find patient for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


    public function destroy($id)
    {
        try {

            $model = new Patient();
            $patient = $model->findPatientById($id);
            $model->delete($patient);

            return $this
                ->getResponse(
                    [
                        'message' => 'Patient deleted successfully',
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
