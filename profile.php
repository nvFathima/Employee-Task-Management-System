<?php 
    session_start();
    if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
        include "DB_connection.php";
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h2 class="title">My Profile </h2>
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
					<p><span style="font-weight:bold;">Title: </span><p>
				</div>
				<div class="input-holder">
					<label>Description: </label>
                    <textarea name="description" class="input-1" disabled></textarea><br>
				</div>
				
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