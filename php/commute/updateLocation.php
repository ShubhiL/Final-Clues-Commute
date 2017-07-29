<?php
 
   require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
 
  // json response array
     $response = array("error" => FALSE);
	 
	 if (isset($_POST['driver_id'])&& isset($_POST['current_lat'])&& isset($_POST['current_long']))
	 {
	    	$driver_id = $_POST['driver_id'];
		$current_lat = $_POST['current_lat'];
		$current_long = $_POST['current_long'];
		
		if ($db->updateLatLong($driver_id, $current_lat, $current_long))
		{
			$response["response"] = "Location updated";
			echo json_encode($response);
		}
		else {
        	// user is not found with the given credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "One or more parameters is not correct. Please try again!";
			echo json_encode($response);
  	  }
	}
	else {
    //required  params is missing
	    $response["error"] = TRUE;
	    $response["error_msg"] = "Required parameters are missing!";
	    echo json_encode($response);
            }
?>
