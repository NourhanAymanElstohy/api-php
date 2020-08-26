<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/employee.php';

$database = new Database();
$db = $database->connect();

$emp = new Employee($db);

$data = json_decode(file_get_contents("php://input"));

if($data->name === null || $data->phone === null || $data->age === null || $data->is_mgr === null || $data->dept_id === null){
    echo json_encode(array("message" => 'Null data'));
}
else {
    $emp->name = $data->name;
    $emp->phone = $data->phone;
    $emp->age = $data->age;
    $emp->is_mgr = $data->is_mgr;
    $emp->dept_id = $data->dept_id;

    if ($emp->create()) {
        echo json_encode(array("message" => 'Employee added'));
    } else {
        echo json_encode(array("message" => 'Employee not added'));
    }

}


