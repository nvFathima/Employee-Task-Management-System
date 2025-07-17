<?php 
	session_start();
	if(isset($_SESSION['role']) && isset($_SESSION['id'])&& $_SESSION['role'] == "admin"){ 
		include "DB_connection.php";
		include "app/Model/Users.php";
		$users = get_all_users($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Tasks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_responsive.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
            <h4 class="title">Create Task</h4>
			<form class="form-1" method="POST" action="app/add_task.php">
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
					<input type="text" name="title" class="input-1" placeholder="Title"><br>
				</div>
				<div class="input-holder">
					<label>Description</label>
					<textarea type="text" name="description" class="input-1" placeholder="Description"></textarea><br>
				</div>
				<div class="input-holder">
					<label>Due Date</label>
					<input type="date" name="due_date" class="input-1" placeholder="Due Date"><br>
				</div>
				<div class="input-holder">
					<label>Assigned to</label>
					<select name="assigned_to" class="input-1">
						<option value="" disabled selected>Select employee</option>
						<?php if ($users !=0) { 
							foreach ($users as $user) {
						?>
                  		<option value="<?=$user['id']?>"><?=$user['full_name']?></option>
						<?php } } ?>
					</select><br>
				</div>
				<button class="edit-btn">Create Task</button>
			</form>
		</section>
	</div>
</body>
</html>

<?php 
	}else{
		$em = "Please Login First";
        header("Location: login.php?error=$em");
        exit();
 	}
?>