<?php
require __DIR__ . '/src/Controller.php';
require __DIR__ . '/src/Gateway.php';
require __DIR__ . '/src/Database.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
  header("HTTP/1.1 200 OK");
  die();
}

$database = new Database("sql7.freesqldatabase.com", "sql7742707", "sql7742707", "etg3gtaKcM"); //freesqldatabase
// $database = new Database("sql206.infinityfree.com", "if0_37565478_products", "if0_37565478", "3zI01fla1JyQ"); //infinityfree doesn't work
// $database = new Database("localhost", "products", "root", ""); //localhost

$gateway = new Gateway($database);

$controller = new Controller($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"]);
