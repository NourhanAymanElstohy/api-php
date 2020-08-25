<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");

include_once '../config/database.php';
include_once '../employee.php';

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

// if ($res > 0) {
//     $emp_arr = array();
//     $emp_arr['data'] = array();

//     while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
//         extract($row);

//         $emp_item = array(
//             'id' => $id,
//             'name' => $name,
//             'phone' => $phone,
//             'age' => $age
//         );
//         array_push($emp_arr['data'], $emp_item);
//     }
//     echo json_encode($emp_arr);
// } else {
//     echo json_encode(array("message" => 'no employees'));
// }
