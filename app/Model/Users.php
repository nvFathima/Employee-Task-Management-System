<?php 
    function get_all_users($conn){
        $sql = "SELECT * FROM users WHERE role =? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["employee"]);

        if($stmt->rowCount() > 0){
            $users = $stmt->fetchAll();
        }else $users = 0;

        return $users;
    }

    function get_user_by_id($conn, $id){
        $sql = "SELECT * FROM users WHERE id =? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch();
        }else $user = 0;

        return $user;
    }

    function insert_user($conn, $data){
        $sql = "INSERT INTO users (full_name, username, password, role) VALUES(?,?,?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function update_user($conn, $data){
        $sql = "UPDATE users SET full_name=?, username=?, password=?, role=? WHERE id=? AND role=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function update_user_without_password($conn, $full_name, $username, $id){
        $sql = "UPDATE users SET full_name=?, username=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$full_name, $username, $id]);
    }

    function get_user_by_username($conn, $username){
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        
        if($stmt->rowCount() >= 1){
            $user = $stmt->fetch();
            return $user;
        }else {
            return 0;
        }
    }

    function get_admin($conn, $role){
        $sql = "SELECT * FROM users WHERE role=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$role]);
        
        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            return $user;
        }else {
            return 0;
        }
    }

    function get_userid_by_task($conn, $id){
        $sql = "SELECT u.id FROM users u JOIN tasks t ON u.id = t.assigned_to WHERE t.id =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if($stmt->rowCount() >= 1){
            $user = $stmt->fetch();
            return $user['id'];
        }else {
            return 0;
        }
    }

    function delete_user($conn, $id){
        $sql = "DELETE from users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }

    function count_users($conn){
        $sql = "SELECT id FROM users WHERE role='employee'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }
?>