<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['employee_id']) && isset($_POST['password'])) {
 
    // receiving the post params
    $employee_id= $_POST['employee_id'];
    $password = $_POST['password'];

    // check if user is already existed with the same email
    if ($db->isUserExisted($employee_id)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $employee_id;
        echo json_encode($response);
    } 
    //inserted

   //  else if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
   //              $response["error"] = TRUE;
   //              $response["error_msg"] = "Invalid email- " . $email;
   //              echo json_encode($response);

   // }

    // else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        
    //     list ($user, $domain) = explode('@', $email);
    //     $isGmail = ($domain == 'shopclues.com');
    //     if(!$isGmail){
    //          $response["error"] = TRUE;
    //          $response["error_msg"] = "Invalid email- " . $email;
    //          echo json_encode($response);
    //     }

    // }
    //   else if($match!=0){

    //          $response["error"] = TRUE;
    //          $response["error_msg"] = "Invalid email- " . $email;
    //          echo json_encode($response);

    // }

    else {
        // create a new user
        $user = $db->storeUser($employee_id, $password);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["employee_id"] = $user["employee_id"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
}else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (employee_id or password) is missing!";
    echo json_encode($response);
}
?>
