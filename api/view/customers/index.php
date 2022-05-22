<?php

require_once("../../../global.php");

header('Access-Control-Allow-Origin: *');

use Api\Controller\Customers\CustomersController;

echo json_encode(
	(
		new CustomersController()
	)->fetchAll()
);
