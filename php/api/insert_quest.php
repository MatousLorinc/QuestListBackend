<?php
// API expects fields: name, type, start, end
header('Access-Control-Allow-Origin: *');

include_once  __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Quest.php';

$database = new Database();
$connection = $database->connect();


$success = false;

$name = filter_input(INPUT_POST,'name');
$type = (int)filter_input(INPUT_POST,'type');
$start = filter_input(INPUT_POST,'start');
$end = filter_input(INPUT_POST,'end');

$quest = new Quest();
$quest->setQuest($name,$type,$start,$end);
if($quest->insertQuest($connection)){
    $success = true;
}

$msg = "jmeno : $name, typ : $type, start : $start, end : $end";
$response = ["success" => $success,
            "message" => $msg];
echo json_encode($response, JSON_UNESCAPED_UNICODE);

$database = null;
