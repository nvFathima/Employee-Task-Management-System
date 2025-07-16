<?php
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['field'])&& $_SESSION['role'] == 'employee'){
            include 'Model/Users.php';
            include 'Model/Task.php';
            include 'Model/Notification.php';
            include '../DB_connection.php';
            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $field = validate_input($_POST['field']);
            $message = validate_input($_POST['message']? $_POST['message']: "No Additional Message!");
            
            $data = array($field, $message);
            $admin = get_admin($conn, 'admin');
            $user = get_user_by_id($conn, $_SESSION['id']);
            $username = $user['username'];
            $notif_data = array("$field edit request: $message; from $username", $admin['id'], 'Profile Edit Request', date("Y-m-d"));
            insert_notification($conn, $notif_data);

            $em = "Request sent successfully";
            header("Location: ../edit_profile.php?success=$em&id=$id");
            exit();

        }else{
            $em = "unknown error occurred";
            header("Location: ../edit_profile.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: ../login.php?error=$em&id=$id");
        exit();
 	}
?>