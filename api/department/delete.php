<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/department.php';

$database = new Database();
$db = $database->connect();

$dept = new Department($db);

$data = json_decode(file_get_contents("php://input"));

$dept->id = $data->id;

if ($dept->delete()) {
    echo json_encode(array("message" => 'Department deleted'));
} else {
    echo json_encode(array("message" => 'Department not deleted'));
}
