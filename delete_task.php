<?php 
    session_start();
    if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
        if (isset($_POST['id'])&& $_SESSION['role'] == 'admin'){
            include './app/Model/Task.php';
            include 'DB_connection.php';

            function validate_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $id = validate_input($_POST['id']);
            
            $task = get_task_by_id($conn, $id);
            if ($task == 0) {
                header("Location: tasks.php");
                exit();
            }

            delete_task($conn, $id);

            $em = "Task deleted successfully";
            header("Location: tasks.php?success=$em");
            exit();

        }else{
            $em = "unknown error occurred";
            header("Location: tasks.php?error=$em&id=$id");
            exit();
        }
    }else{
		$em = "Please Login First";
        header("Location: login.php?error=$em&id=$id");
        exit();
 	}
?>