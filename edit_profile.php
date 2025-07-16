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
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h4 class="title">Edit Profile <a href="profile.php">Profile</a></h4>
            <p style="font-style:italic;color:red">You can only request admin for editing profile</p>
         <form class="form-1"
			      method="POST"
			      action="app/edit_profile_request.php">
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
					<label>Select a field</label>
					<select name="field" class="input-1">
						<option value="" disabled selected>Select field to request change</option>
                        <option value="Full name">Full Name</option>
                        <option value="User name">User Name</option>
                        <option value="password">Password</option>
					</select>
				</div>
				<div class="input-holder">
					<label>Message (Optional)</label>
					<textarea type="text" name="message" class="input-1" placeholder="Message here..."></textarea><br>
				</div>
				<button class="edit-btn">Request</button>
			</form>

		</section>
	</div>

</body>
</html>
<?php }else{ 
   $em = "First login";
   header("Location: login.php?error=$em");
   exit();
}
 ?>