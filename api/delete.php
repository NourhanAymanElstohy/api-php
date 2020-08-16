<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../employee.php';

$database = new Database();
$db = $database->connect();

$emp = new Employee($db);

$data = json_decode(file_get_contents("php://input"));

$emp->id = $data->id;

if ($emp->delete()) {
    echo json_encode(array("message" => 'Employee deleted'));
} else {
    echo json_encode(array("message" => 'Employee not deleted'));
}
