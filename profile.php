<?php 
    session_start();
    if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
        include "DB_connection.php";
		include "app/Model/Users.php";
		$user = get_user_by_id($conn, $_SESSION['id']);
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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
			<h2 class="title">My Profile <a href="edit_profile.php">Edit Request</a></h2>
			<table class="main-table">
				<tr>
					<td>Full Name</td>
					<td><?=$user['full_name']?></td>
				</tr>
				<tr>
					<td>User name</td>
					<td><?=$user['username']?></td>
				</tr>
				<tr>
					<td>Joined At</td>
					<td><?=$user['created_at']?></td>
				</tr>
			</table><br>
			<p style="font-style:italic">* You can only request admin for editing profile</p>
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