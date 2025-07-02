<?php 
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['id'])&& $_SESSION['role'] == 'admin'){
            include './app/Model/Users.php';
            include 'DB_connection.php';

            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $id = validate_input($_POST['id']);
            
            $user = get_user_by_id($conn, $id);
            if ($user == 0) {
                header("Location: users.php");
                exit();
            }

            delete_user($conn, $id);

            $em = "User removed successfully";
            header("Location: users.php?success=$em");
            exit();

        }else{
            $em = "unknown error occurred";
            header("Location: users.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: login.php?error=$em&id=$id");
        exit();
 	}
?>