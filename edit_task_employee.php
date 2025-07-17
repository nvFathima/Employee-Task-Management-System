<?php 
    session_start();
    if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
        include "DB_connection.php";
		include "app/Model/Task.php";

        if(!isset($_GET['id'])){
            header("Location: my_task.php");
            exit();
        }

        $id = $_GET['id'];
		$task = get_task_by_id($conn, $id);

        if($task == 0){
            header("Location: my_task.php");
            exit();
        }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Task</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_responsive.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<div class="mobile-overlay"></div>
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h2 class="title">Edit Task <a href="my_task.php">All Tasks</a></h2>
			<form class="form-1" method="POST" action="app/update_task_employee.php">
			    <?php if (isset($_GET['error'])) {?>
                    <div class="danger" role="alert">
                    <?php echo stripcslashes($_GET['error']); ?>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['success'])) {?>
                    <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>

				<div class="input-holder">
					<p><span style="font-weight:bold;">Title: </span><?=$task['title']?></p>
				</div>
				<div class="input-holder">
					<label>Description: </label>
                    <textarea name="description" class="input-1" disabled><?=$task['description']?></textarea><br>
				</div>
				<div class="input-holder">
					<label>Status: </label>
					<select name="status" class="input-1">
						<option value="pending" <?php echo ($task['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
						<option value="in_progress" <?php echo ($task['status'] == 'in_progress') ? 'selected' : ''; ?>>In-Progress</option>
						<option value="completed" <?php echo ($task['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
					</select><br>
				</div>
                <input type="text" name="id" value="<?=$task['id']?>" hidden>
				<input type="text" name="title" value="<?=$task['title']?>" hidden>
				<button class="edit-btn">Update</button>
			</form>	
		</section>
	</div>
</body>
</html>
<?php }else{ 
   $em = "Please Login First";
   header("Location: login.php?error=$em");
   exit();
}
 ?>