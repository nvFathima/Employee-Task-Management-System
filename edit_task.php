<?php 
    session_start();
    if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
        include "DB_connection.php";
		include "app/Model/Task.php";

        if(!isset($_GET['id'])){
            header("Location: tasks.php");
            exit();
        }

        $id = $_GET['id'];
		$task = get_task_by_id($conn, $id);

        if($task == 0){
            header("Location: tasks.php");
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
			<h2 class="title">Edit Task <a href="tasks.php">All Tasks</a></h2>
			<form class="form-1" method="POST" action="app/update_task.php">
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
					<label>Title</label>
					<input type="text" name="title" value="<?=$task['title']?>" class="input-1" placeholder="Enter the title here"><br>
				</div>
				<div class="input-holder">
					<label>Description</label>
                    <textarea name="description" class="input-1" placeholder="Description here"><?=$task['description']?></textarea><br>
				</div>
				<div class="input-holder">
					<label>Due Date</label>
					<input type="date" name="due_date" value="<?=$task['due_date']?>" class="input-1" placeholder="Due Date"><br>
				</div>
                <input type="text" name="id" value="<?=$task['id']?>" hidden>
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