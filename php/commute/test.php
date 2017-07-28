<?php
 
require_once 'include/DB_Functions.php';

$db = new DB_Functions();
 
// json response array 
if (isset($_GET['employee_id'])) {
 
    $employee_id= $_GET['employee_id'];
    
    $result = $db->fetchOnePassengerFromRoute($employee_id);

    //print_r($result);

    echo (json_encode($db->fetchFromMain($result)));
    }
    else{
        echo "ERRR";
    }
?>