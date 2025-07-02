<?php
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['user_name']) && isset($_POST['password'])&& isset($_POST['full_name'])){
            include '../DB_connection.php';
            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $user_name = validate_input($_POST['user_name']);
            $password = validate_input($_POST['password']);
            $full_name = validate_input($_POST['full_name']);

            if (empty($full_name)){
                $em = "Full name is required";
                header("Location: ../add_user.php?error=$em");
                exit();
            }else if (empty($user_name)){
                $em = "User name is required";
                header("Location: ../add_user.php?error=$em");
                exit();
            }else if (empty($password)){
                $em = "Password is required";
                header("Location: ../add_user.php?error=$em");
                exit();
            }else {
                include "Model/Users.php";
                $password = password_hash($password, PASSWORD_ARGON2ID);

                $data = array($full_name, $user_name, $password, "employee");
                insert_user($conn, $data);

                $em = "User created successfully";
                header("Location: ../add_user.php?success=$em");
                exit();
            }

        }else{
            $em = "unknown error occurred";
            header("Location: ../login.php?error=$em");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: ../login.php?error=$em");
        exit();
 	}
?>