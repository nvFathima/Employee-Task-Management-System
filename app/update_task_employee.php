<?php
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['status'])&& $_SESSION['role'] == 'employee'){
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

            $status = validate_input($_POST['status']);
            $id = validate_input($_POST['id']);
            $title = validate_input($_POST['title']);
            
            $data = array($status, $id);
            update_task_employee($conn, $data);

            $admin = get_admin($conn, 'admin');
            $notif_data = array(" Status of '$title' has been updated. Please check.", $admin['id'], 'Task Updated', date("Y-m-d"));
            insert_notification($conn, $notif_data);

            $em = "Task updated successfully";
            header("Location: ../edit_task_employee.php?success=$em&id=$id");
            exit();

        }else{
            $em = "unknown error occurred";
            header("Location: ../edit_task_employee.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: ../login.php?error=$em&id=$id");
        exit();
 	}
?>