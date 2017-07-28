<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['driver_id']) && isset($_POST['passenger_id'])) {
 
    // receiving the post params
    $driver_id= $_POST['driver_id'];
    $passenger_id = $_POST['passenger_id'];

 
    // check if user is already existed with the same email
    if ($db->updateStatus($driver_id, $passenger_id, 2)) {
        // user already existed
        $response["response"] = TRUE;
        
        echo json_encode($response);
    } 

    else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Updation Unsuccessful!";
            echo json_encode($response);
        }
    }
else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (driver_id or passenger_id) is missing!";
    echo json_encode($response);
}
?>