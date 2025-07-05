<?php 

    function get_all_tasks($conn){
        $sql = "SELECT t.id, t.title, t.description, t.due_date, t.status, u.full_name 
                FROM tasks t 
                JOIN users u ON t.assigned_to = u.id";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        if($stmt->rowCount() > 0){
            $tasks = $stmt->fetchAll();
        } else {
            $tasks = 0;
        }

        return $tasks;
    }

    function get_all_tasks_by_id($conn, $id){
        $sql = "SELECT * FROM tasks WHERE assigned_to =? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0){
            $tasks = $stmt->fetchAll();
        }else $tasks = 0;

        return $tasks;
    }

    function get_task_by_id($conn, $id){
        $sql = "SELECT * FROM tasks WHERE id =? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $task = $stmt->fetch();
        }else $task = 0;

        return $task;
    }

    function insert_task($conn, $data){
        $sql = "INSERT INTO tasks (title, description, assigned_to, due_date) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function update_task($conn, $data){
        $sql = "UPDATE tasks SET title=?, description=?, due_date=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function update_task_employee($conn, $data){
        $sql = "UPDATE tasks SET status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function delete_task($conn, $id){
        $sql = "DELETE from tasks WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }
?>