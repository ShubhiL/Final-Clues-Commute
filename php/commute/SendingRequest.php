 
 <?php  // API TO SEND REQUEST
       
	require_once 'include/DB_Functions.php';
       	$db = new DB_Functions(); 

	// json response array  
      $response = array("error" => FALSE);
      									 
      if (isset($_GET['requester_id']) && isset($_GET['requestee_id']))
      {
          // receiving the parameters
          $requester_id = $_GET['requester_id'];
          $requestee_id = $_GET['requestee_id'];
          
          //checking access type
          if($db->fetchFromUsersAccessType($requester_id)==="driver"){
	
	//FOR ACCESS_TYPE = DRIVER	  
            // IF  request already exist in REQUEST table
            if ($db->doRequestExisted($requester_id,$requestee_id)){ 

                  $response["error"]= TRUE;
                  $response["error_msg"] = "Request already exist in Request table";
                  echo json_encode($response);
              }
              // store request in database
              else if ($db->storeRequest($requester_id, $requestee_id, $requester_id))
                 {
                    $response['error'] = FALSE;
                    $response['response'] = TRUE;
                    echo json_encode($response);
              }
              
              else {
                  $response["error"] = TRUE;
                  $response['error_msg'] = "Request Cannot be Sent";
                  echo json_encode($response);
              }

          }

          else{
		  //FOR ACCESS TYPE = PASSENGER
            if ($db->doRequestExisted($requestee_id,$requester_id)){ 

                  $response["error"]= TRUE;
                  $response["error_msg"] = "Request has been already sent";
                  echo json_encode($response);
              }
              
              else if ($db->storeRequest($requestee_id, $requester_id, $requester_id))
                 {
                    $response['error'] = FALSE;
                    $response['response'] = TRUE;
                    echo json_encode($response);
              }
              
              else {

                  $response["error"] = TRUE;
                  $response['error_msg'] = "Request Cannot be Sent";
                  echo json_encode($response);
              }

          }
      	
      } 
         else {
          $response["error"] = TRUE;
          $response["error_msg"] = "Required parameters are missing!";
          echo json_encode($response);
          }
?>

