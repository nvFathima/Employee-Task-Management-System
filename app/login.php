<?php
    session_start();
    if (isset($_POST['user_name']) && isset($_POST['password'])){
        include '../DB_connection.php';
        function validate_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
	    }

        $user_name = validate_input($_POST['user_name']);
        $password = validate_input($_POST['password']);

        if (empty($user_name)){
            $em = "User name is required";
            header("Location: ../login.php?error=$em");
            exit();
        }else if (empty($password)){
            $em = "Password is required";
            header("Location: ../login.php?error=$em");
            exit();
        }else {
            $sql = "SELECT * FROM users where username=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_name]);

            if ($stmt -> rowCount()== 1){
                $user = $stmt->fetch();
                $username_DB = $user['username'];
                $password_DB = $user['password'];
                $role = $user['role'];
                $id = $user['id'];

                if ($user_name === $username_DB){

                    if(password_verify($password, $password_DB)){
                        if($role === 'admin'){
                            $_SESSION['role'] = $role;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username_DB;
                            header("Location: ../index.php");

                        }else if($role === 'employee'){
                            $_SESSION['role'] = $role;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username_DB;
                            header("Location: ../index.php");

                        }else{
                            $em = "User does not exists";
                            header("Location: ../login.php?error=$em");
                            exit();    
                        }
                    }
                    else{
                        $em = "incorrect username or password";
                        header("Location: ../login.php?error=$em");
                        exit();            
                    }
                }else{
                    $em = "incorrect username or password";
                    header("Location: ../login.php?error=$em");
                    exit();            
                }
            }
        }

    }else{
        $em = "unknown error occurred";
        header("Location: ../login.php?error=$em");
        exit();
    }
?>