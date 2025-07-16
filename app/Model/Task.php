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

    function get_all_tasks_due_today($conn){
        $sql = "SELECT t.id, t.title, t.description, t.due_date, t.status, u.full_name 
                FROM tasks t 
                JOIN users u ON t.assigned_to = u.id 
                WHERE t.due_date = CURDATE() AND t.status != 'completed' ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        if($stmt->rowCount() > 0){
            $tasks = $stmt->fetchAll();
        }else $tasks = 0;

        return $tasks;
    }

    function count_tasks_due_today($conn){
        $sql = "SELECT id FROM tasks WHERE due_date = CURDATE() AND status != 'completed'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function get_all_tasks_overdue($conn){
        $sql = "SELECT t.id, t.title, t.description, t.due_date, t.status, u.full_name 
                FROM tasks t 
                JOIN users u ON t.assigned_to = u.id 
                WHERE due_date > '0000-00-00' AND due_date < CURDATE() AND status != 'completed' ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        if($stmt->rowCount() > 0){
            $tasks = $stmt->fetchAll();
        }else $tasks = 0;

        return $tasks;
    }

    function count_tasks_overdue($conn){
        $sql = "SELECT id FROM tasks WHERE due_date < CURDATE() AND status != 'completed'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function get_all_tasks_NoDeadline($conn){
        $sql = "SELECT t.id, t.title, t.description, t.due_date, t.status, u.full_name 
                FROM tasks t 
                JOIN users u ON t.assigned_to = u.id 
                WHERE t.status != 'completed' AND t.due_date IS NULL OR t.due_date = '0000-00-00' ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        if($stmt->rowCount() > 0){
            $tasks = $stmt->fetchAll();
        }else $tasks = 0;

        return $tasks;
    }

    function count_tasks_NoDeadline($conn){
        $sql = "SELECT id FROM tasks WHERE status != 'completed' AND due_date IS NULL OR due_date = '0000-00-00'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function count_tasks($conn){
        $sql = "SELECT id FROM tasks";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function count_pending_tasks($conn){
        $sql = "SELECT id FROM tasks WHERE status = 'pending' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function count_in_progress_tasks($conn){
        $sql = "SELECT id FROM tasks WHERE status = 'in_progress' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
    }

    function count_completed_tasks($conn){
        $sql = "SELECT id FROM tasks WHERE status = 'completed' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        return $stmt->rowCount();
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

    function delete_task($conn, $id){
        $sql = "DELETE from tasks WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
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

    function count_my_tasks($conn, $id){
        $sql = "SELECT id FROM tasks where assigned_to = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function count_my_tasks_overdue($conn, $id){
        $sql = "SELECT id FROM tasks 
        where due_date > '0000-00-00' AND due_date < CURDATE() AND status != 'completed' AND assigned_to = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function count_my_tasks_NoDeadline($conn, $id){
        $sql = "SELECT id FROM tasks where status != 'completed' AND assigned_to = ? AND (due_date IS NULL OR due_date = '0000-00-00')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function count_my_pending_tasks($conn, $id){
        $sql = "SELECT id FROM tasks WHERE assigned_to = ? AND status = 'pending' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function count_my_in_progress_tasks($conn, $id){
        $sql = "SELECT id FROM tasks WHERE assigned_to = ? AND status = 'in_progress' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function count_my_completed_tasks($conn, $id){
        $sql = "SELECT id FROM tasks WHERE assigned_to = ? AND status = 'completed' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    function update_task_employee($conn, $data){
        $sql = "UPDATE tasks SET status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

?>