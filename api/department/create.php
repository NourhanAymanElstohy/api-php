<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/department.php';

$database = new Database();
$db = $database->connect();

$dept = new Department($db);

$data = json_decode(file_get_contents("php://input"));

if ($data->name === null ) {
    echo json_encode(array("message" => 'Null data'));
} else {
    $dept->name = $data->name;
    if ($dept->create()) {
        echo json_encode(array("message" => 'Department added'));
    } else {
        echo json_encode(array("message" => 'Department not added'));
    }
}
