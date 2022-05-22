<?php

namespace Api\Model\Customers;

use Api\Model\Connection\Connection;

/**
 * Classe para executar consultas ao banco de dados referente a tabela CUSTOMER
 * @author Alfredo Oliveira <alfredoaugusto.g@gmail.com>
 */
class CustomersModel extends Connection
{
    /**
     * Metodo responsavel por executar a query principal de clientes
     * @return array
     */
    public function fetch() : array
    {
        $query = "SELECT
                   id,
                   first_name,
                   last_name,
                   email,
                   gender,
                   ip_address,
                   company,
                   city,
                   title,
                   website
                FROM
                    CUSTOMERS
                ";
        
        return $this->execute(
            $query,
            array()
        );
    }

    /**
     * Metodo responsavel inserir um registro na tabela CUSTOMERS
     */
    public function insert($data)
    {
        $keys = [];
        $values = [];
        $id =  $data->id;
        
        foreach ($data as $key => $value) {
            array_push($keys, $key);
            $formatValue = substr($value, 0, 255);
            array_push($values, "'{$formatValue}'");
        }

        $columnsInsert = implode(", ", $keys);
        $valInsert = implode(", ", $values);

        $query = "  INSERT INTO
                        CUSTOMERS ({$columnsInsert})
                    SELECT
                        {$valInsert}
                    WHERE NOT EXISTS (
                        SELECT 1 FROM CUSTOMERS WHERE id = '{$id}'
                    );";

        return $this->execute(
            $query,
            array()
        );
    }
}
