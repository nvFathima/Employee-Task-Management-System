<?php 
    session_start();
    if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
        include "DB_connection.php";
		include "app/Model/Users.php";

        if(!isset($_GET['id'])){
            header("Location: users.php");
            exit();
        }

        $id = $_GET['id'];
		$user = get_user_by_id($conn, $id);

        if($user == 0){
            header("Location: users.php");
            exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
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
			<h2 class="title">Edit User <a href="users.php">All Users</a></h2>
			<form class="form-1"
			      method="POST"
			      action="app/update_user.php">
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
					<label>Full Name</label>
					<input type="text" name="full_name" value="<?=$user['full_name']?>" class="input-1" placeholder="Full Name"><br>
				</div>
				<div class="input-holder">
					<label>Username</label>
					<input type="text" name="user_name" value="<?=$user['username']?>" class="input-1" placeholder="Username"><br>
				</div>
				<div class="password-section">
                    <div class="password-toggle">
                        <label>
                            <input type="checkbox" id="updatePassword" name="update_password" value="1">
                            Update Password
                        </label>
                    </div>
                    
                    <div class="current-password-info">
                        Current password will remain unchanged unless you check the box above
                    </div>
                    
                    <div class="password-fields" id="passwordFields">
                        <div class="input-holder">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="input-1" placeholder="Enter new password">
                        </div>
                        
                        <div class="input-holder">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="input-1" placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
                <input type="text" name="id" value="<?=$user['id']?>" hidden>
				<button class="edit-btn">Update</button>
			</form>	
		</section>
	</div>

<script type="text/javascript">

    document.getElementById('updatePassword').addEventListener('change', function() {
            const passwordFields = document.getElementById('passwordFields');
            const newPasswordInput = document.querySelector('input[name="new_password"]');
            const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
            
            if (this.checked) {
                passwordFields.classList.add('show');
                newPasswordInput.required = true;
                confirmPasswordInput.required = true;
            } else {
                passwordFields.classList.remove('show');
                newPasswordInput.required = false;
                confirmPasswordInput.required = false;
                newPasswordInput.value = '';
                confirmPasswordInput.value = '';
            }
        });
</script>
</body>
</html>
<?php }else{ 
   $em = "Please Login First";
   header("Location: login.php?error=$em");
   exit();
}
 ?>