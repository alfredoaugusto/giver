<?php

use PHPUnit\Framework\TestCase;
use Api\Controller\Customers\CustomersController;

/**
 * Classe de testes
 * @author Alfredo Oliveira <alfredoaugusto.g@gmail.com>
 */
class CustomersControllerTest extends TestCase
{
    /**
     * Metodo responsavel por testar retorno vazio do fetchAll da CustomersController
     * @return void
     */
    public function testFetchAllEmpty() : void
    {
        $mockDbValues = [];

        $stub = $this->createMock(CustomersController::class);

        $stub->method('fetchAll')
              ->willReturn($mockDbValues);
        
        $data = $stub->fetchAll();

        $this->assertTrue((int) count($data) === 0);
    }

    /**
     * Metodo responsavel por testar retorno com valores do fetchAll da CustomersController
     * @return void
     */
    public function testFetchAllValues() : void
    {
        $mockDbValues = [
            ['id' => 1, 'firts_name' => 'Alfredo'],
            ['id' => 2, 'firts_name' => 'Joni']
        ];

        $stub = $this->createMock(CustomersController::class);

        $stub->method('fetchAll')
              ->willReturn($mockDbValues);
        
        $data = $stub->fetchAll();

        $this->assertEquals(2, (int) count($data));
    }

    /**
     * Metodo responsavel por testar retorno do metodo pra adicionar itens ao DB
     * @return void
     */
    public function testAdd() : void
    {
        $stub = $this->createMock(CustomersController::class);

        $stub->method('add')
              ->willReturn(['success' => true]);

        $data = $stub->add([]);

        $this->assertEquals(true, $data['success']);
    }

    /**
     * Metodo responsavel por testar retorno dos dados do grafico
     * @return void
     */
    public function testFetchChartInfo() : void
    {
        $mockDbValues = [
            ['id' => 1, 'firts_name' => 'Alfredo', 'last_name' => 'Oliveira', 'email' => '@@@@gg', 'gender' => 'Male'],
            ['id' => 2, 'firts_name' => 'Joni', 'email' => 'joni@giver.com', 'gender' => 'Male'],
            ['id' => 3, 'firts_name' => 'Schay', 'email' => 'schay@schay.com', 'gender' => 'Female']
        ];

        $stub = $this->createMock(CustomersController::class);

        $stub->method('fetchAll')
              ->willReturn($mockDbValues);

        $this->assertTrue(is_array($stub->fetchChartInfo()));
    }

    /**
     * Metodo responsavel por testar retorno do metodo getModel
     * @return void
     */
    public function testGetModel() : void
    {
        $method = new ReflectionMethod('Api\Controller\Customers\CustomersController', 'getModel');
        $method->setAccessible(true);

        $customerControllerInstance = new CustomersController();

        $method->invokeArgs($customerControllerInstance, array());
        $exposedResponse = $method->invoke($customerControllerInstance);

        $this->assertEquals('Api\Model\Customers\CustomersModel', $exposedResponse::class);
    }
}
