<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");

include_once '../config/database.php';
include_once '../models/employee.php';

$database = new Database();
$db = $database->connect();

$emp = new Employee($db);

$res = $emp->read();

if ($res > 0) {
    $emp_arr = array();
    $emp_arr['data'] = array();

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $emp_item = array(
            'id' => $id,
            'is_manager' => $is_mgr,
            'employee_name' => $name,
            'phone' => $phone,
            'age' => $age,
            'department' => array(
                'dept_id' => $dept_id,
                'dept_name' => $dept_name
            )
            
        );
        array_push($emp_arr['data'], $emp_item);
    }
    echo json_encode($emp_arr);
} else {
    echo json_encode(array("message" => 'no employees'));
}
