<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$response = array("error" => FALSE);

// json response array 
if (isset($_GET['employee_id'])) {
 
    // receiving the params
    $employee_id= $_GET['employee_id'];

    if($db->fetchFromUsersAccessType($employee_id)==="driver"){
    $result = $db->getSameZonePeople($employee_id);

    if($result){
      for ($i=0; $i<count($result); $i++)
        {
            //employee_id, employee_name, address, designation, owns_vehicle, mobile_number, gender 

            $response["response"][$i] = array("employee_id"=>$result[$i][0],"employee_name"=>$result[$i][1],"address"=>$result[$i][2],"designation"=>$result[$i][3],"owns_vehicle"=>$result[$i][4],"mobile_number"=>$result[$i][5],"gender"=>$result[$i][6]);
        }
    echo json_encode($response);  
    }
    else{
            $response["error"] = TRUE;
            $response["error_msg"] = "No Employee Lives in Your Zone";
            echo json_encode($response);
        }
    }
    else{
            $response["error"] = TRUE;
            $response["error_msg"] = "Not a Driver! can't access";
            echo json_encode($response);
        }
    }

    else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Required parameter (employee_id) is missing!";
        echo json_encode($response);
   }
?>
