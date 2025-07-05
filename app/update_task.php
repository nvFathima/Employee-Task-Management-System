<?php
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['title'])&& isset($_POST['due_date'])&& $_SESSION['role'] == 'admin'){
            include 'Model/Task.php';
            include '../DB_connection.php';
            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $title = validate_input($_POST['title']);
            $due_date = validate_input($_POST['due_date']);
            $id = validate_input($_POST['id']);
            $description = isset($_POST['description']) && trim($_POST['description']) !== '' 
                            ? validate_input($_POST['description']) 
                            : 'No description provided';

            if (empty($title)){
                $em = "Title is required";
                header("Location: ../edit_task.php?error=$em&id=$id");
                exit();
            }else if (empty($due_date)){
                $em = "Due date is required";
                header("Location: ../edit_task.php?error=$em&id=$id");
                exit();
            }else{
                $data = array($title, $description, $due_date, $id);
                update_task($conn, $data);

                $em = "Task updated successfully";
                header("Location: ../edit_task.php?success=$em&id=$id");
                exit();
            }

        }else{
            $em = "unknown error occurred";
            header("Location: ../edit_task.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: ../login.php?error=$em&id=$id");
        exit();
 	}
?>