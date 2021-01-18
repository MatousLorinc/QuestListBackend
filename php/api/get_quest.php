<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once  __DIR__ . '/../config/Database.php';
include_once __DIR__ . '/../models/Quest.php';

$database = new Database();
$connection = $database->connect();
$quests = Quest::getQuests($connection);
$quests_arr = [];

foreach($quests as $quest)
{
    array_push($quests_arr, clone $quest);
} 

echo json_encode($quests_arr, JSON_UNESCAPED_UNICODE);
$database = null;
