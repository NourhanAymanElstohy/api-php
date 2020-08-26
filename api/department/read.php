<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");

include_once '../config/database.php';
include_once '../models/department.php';

$database = new Database();
$db = $database->connect();

$dept = new Department($db);

$res = $dept->read();

if ($res > 0) {
    $dept_arr = array();
    $dept_arr['data'] = array();

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dept_item = array(
            'id' => $id,
            'department_name' => $name,
            
        );
        array_push($dept_arr['data'], $dept_item);
    }
    echo json_encode($dept_arr);
} else {
    echo json_encode(array("message" => 'no departments'));
}
