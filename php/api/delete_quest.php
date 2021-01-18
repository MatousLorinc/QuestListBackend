<?php
// API expects fields: name, type, start, end
header('Access-Control-Allow-Origin: *');

include_once  __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Quest.php';

$database = new Database();
$connection = $database->connect();

$success = false;
$ids_to_delete = json_decode(file_get_contents('php://input'), true);
if(Quest::deleteQuest($connection,$ids_to_delete)){
    $success = true;
}

$database = null;
