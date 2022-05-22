<?php

namespace Api\Controller\Customers;

use Api\Model\Customers\CustomersModel;

/**
 * Classe controladora dos dados dos clientes
 * @author Alfredo Oliveira <alfredoaugusto.g@gmail.com>
 */
class CustomersController
{
    private ?CustomersModel $model = null;

    /**
     * Metodo responsavel por buscar todos os registros do banco de dados
     * @return array
     */
    public function fetchAll() : array
    {
        return (
            $this->getModel()
        )->fetch();
    }

    /**
     * Metodo responsavel por adicionar registros no banco de dados
     * @param array $data
     * @return array
     */
    public function add($data) : array
    {
        $modelInstance = $this->getModel();

        foreach ($data as $value) {
           $modelInstance->insert($value);
        }

        return ['success' => true];
    }

    /**
     * Metodo responsavel por buscar um registro baseado no codigo
     * @param CUSTOMERS.CDCUSTOMER - $cd
     * @return array
     */
    public function fetchChartInfo() : array
    {
        $countWithouLastName = 0;
        $countValidEmail = 0;
        $countInvalidEmail = 0;
        $countWithoutGender = 0;
        $countWithGender = 0;

        $data = $this->fetchAll();

        if (!count($data)) {
            return ['empty' => true];
        }

        foreach ($data as $value) {
            if (empty($value['last_name'])) {
                $countWithouLastName++;
            }
        
            if (filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
                $countValidEmail++;
            } else {
                $countInvalidEmail++;
            }
        
            if ((string) $value['gender'] === 'Female' || (string) $value['gender'] === 'Male') {
                $countWithGender++;
            } else {
                $countWithoutGender++;
            }
        }

        return array(
            'count_without_last_name' => $countWithouLastName,
            'count_valid_email' => $countValidEmail,
            'count_invalid_email' => $countInvalidEmail,
            'count_without_gender' => $countWithoutGender,
            'count_with_gender' => $countWithGender
        );
    }

    /**
     * Metodo responsavel por retornar uma instancia da model CustomersModel
     * @return CustomersModel
     */
    private function getModel() : CustomersModel
    {
        if (!$this->model) {
            $this->model = new CustomersModel();
        }

        return $this->model;
    }
}
