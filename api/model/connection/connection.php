<?php

namespace Api\Model\Connection;

use PDO;
use PDOException;

/**
 * Classe de conexao com o DB
 * @author Alfredo Oliveira <alfredoaugusto.g@gmail.com>
 */
class Connection
{
    private PDO $pdo;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct()
    {
        //O certo seria utilizar a injecao de dependencias para esta conexao
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=giver', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * Metodo responsavel por executar uma query
     * @param string query
     * @param array params
     * @return array
     */
    public function execute(string $query, array $params)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        
        $data = [];

        while ($row = $stmt->fetch()) {
            array_push($data, $row);
        }

        return $data;
    }
}
