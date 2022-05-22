<?php

require_once("../../../global.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

use Api\Controller\Customers\CustomersController;

echo json_encode((
    new CustomersController()
)->add(json_decode($_POST['data'])));
