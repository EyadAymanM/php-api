<?php
require(__DIR__ . './src/Controller.php');
require(__DIR__ . './src/Gateway.php');
require(__DIR__ . './src/Database.php');

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit();
}

// $database = new Database("sql206.infinityfree.com", "if0_37565478_products", "if0_37565478", "3zI01fla1JyQ");
$database = new Database("localhost", "products", "root", "");

$gateway = new Gateway($database);

$controller = new Controller($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"]);
