<?php
require __DIR__ . '/src/Controller.php';
require __DIR__ . '/src/Gateway.php';
require __DIR__ . '/src/Database.php';

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: https://vocal-pony-a43e3a.netlify.app");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit();
}

$database = new Database("sql7.freesqldatabase.com", "sql7742707", "sql7742707", "etg3gtaKcM"); //freesqldatabase
// $database = new Database("sql206.infinityfree.com", "if0_37565478_products", "if0_37565478", "3zI01fla1JyQ"); //infinityfree doesn't work
// $database = new Database("localhost", "products", "root", ""); //localhost

$gateway = new Gateway($database);

$controller = new Controller($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"]);
