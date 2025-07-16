<?php
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['user_name'])&& isset($_POST['full_name'])&& $_SESSION['role'] == 'admin'){
            include 'Model/Users.php';
            include 'Model/Notification.php';
            include '../DB_connection.php';
            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $user_name = validate_input($_POST['user_name']);
            $full_name = validate_input($_POST['full_name']);
            $id = validate_input($_POST['id']);
            $update_password = isset($_POST['update_password']) ? true : false;

            if (empty($full_name)){
                $em = "Full name is required";
                header("Location: ../edit_user.php?error=$em&id=$id");
                exit();
            }else if (empty($user_name)){
                $em = "User name is required";
                header("Location: ../edit_user.php?error=$em&id=$id");
                exit();
            }

            if ($update_password) {
                if (!isset($_POST['new_password']) || empty($_POST['new_password'])){
                    $em = "New password is required when updating password";
                    header("Location: ../edit_user.php?error=$em&id=$id");
                    exit();
                }
                
                if (!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])){
                    $em = "Please confirm the new password";
                    header("Location: ../edit_user.php?error=$em&id=$id");
                    exit();
                }
                
                $new_password = validate_input($_POST['new_password']);
                $confirm_password = validate_input($_POST['confirm_password']);
                
                if ($new_password !== $confirm_password) {
                    $em = "Passwords do not match";
                    header("Location: ../edit_user.php?error=$em&id=$id");
                    exit();
                }
                
                if (strlen($new_password) < 6) {
                    $em = "Password must be at least 6 characters long";
                    header("Location: ../edit_user.php?error=$em&id=$id");
                    exit();
                }
            }

            $existing_user = get_user_by_username($conn, $user_name);
            if ($existing_user && $existing_user['id'] != $id) {
                $em = "Username already exists";
                header("Location: ../edit_user.php?error=$em&id=$id");
                exit();
            }
            $notif_data = [];
            if ($update_password) {
                // Update with new password
                $hashed_password = password_hash($new_password, PASSWORD_ARGON2ID);
                $data = array($full_name, $user_name, $hashed_password, "employee", $id, "employee");
                update_user($conn, $data);
                $notif_data = array("Password has been changed.", $id, 'Profile Updation', date("Y-m-d"));
            } else {
                // Update without changing password
                update_user_without_password($conn, $full_name, $user_name, $id);
                $notif_data = array("Profile has been updated.", $id, 'Profile Updation', date("Y-m-d"));
            }

            insert_notification($conn, $notif_data);

            $em = "User updated successfully";
            header("Location: ../edit_user.php?success=$em&id=$id");
            exit();

        }else{
            $em = "unknown error occurred";
            header("Location: ../login.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: ../login.php?error=$em&id=$id");
        exit();
 	}
?>