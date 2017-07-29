<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_GET['employee_id']) && isset($_GET['access_as'])) {
 
    // receiving the params
    $employee_id= $_GET['employee_id'];
    $access_as = $_GET['access_as'];
 
    if ($db->updateAccess($employee_id, $access_as)) {
        $str = "User's Access Successfully Updated as ";
        if ($access_as==1)
            $str .="Driver";
        else
            $str .="Passenger";

        $response["response"] = $str;
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
    $response["error_msg"] = "Required parameters (employee_id or password) is missing!";
    echo json_encode($response);
}
?>
