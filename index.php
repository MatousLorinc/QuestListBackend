<?php 
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers');

if(isset($_POST['name'])){
    include_once 'php/api/insert_quest.php'; 
}
elseif(file_get_contents('php://input')){
    include_once 'php/api/delete_quest.php'; 
}
else{
    include_once 'php/api/get_quest.php'; 
}





