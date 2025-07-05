<?php 
	session_start();
	if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
		<?php if ($_SESSION['role'] == "admin") { ?>
				<div class="dashboard">
					Hello Admin...
				</div>
			<?php }else{ ?>
				<div class="dashboard">
					Hello Mate...
				</div>
			<?php } ?>
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