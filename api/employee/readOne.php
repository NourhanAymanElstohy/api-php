<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");

include_once '../config/database.php';
include_once '../models/employee.php';

$database = new Database();
$db = $database->connect();

$emp = new Employee($db);

$emp->id = isset($_GET['id']) ? $_GET['id'] : die();

$emp->read_single();

$emp_arr = array (
    'id' => $emp->id,
    'name' => $emp->name,
    'phone' => $emp->phone,
    'age' => $emp->age
);

print_r(json_encode($emp_arr));
