<?php 
	session_start();
	if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
		include "DB_connection.php";
		include "app/Model/Users.php";
		$users = get_all_users($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/confirm_modal.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
            <h4 class="title">Manage Users    <a href="add_user.php">Add User</a></h4>
			<?php if($users != 0){ ?>

            <table class="main-table">
                <tr>
					<th>#</th>
					<th>Full name</th>
					<th>User name</th>
					<th>role</th>
					<th>Action</th>
				</tr>
				<?php $i = 0; foreach($users as $user){ ?>

				<tr>
					<td><?=++$i ?></td>
					<td><?=$user['full_name'] ?></td>
					<td><?=$user['username'] ?></td>
					<td><?=$user['role'] ?></td>
					<td>
						<a href="edit_user.php?id=<?=$user['id']?>" class="edit-btn">Edit</a>
						<button type="button" class = "delete-btn" onclick="openDeleteModal('<?=$user['id']?>')">
							Delete
						</button>
					</td>
				</tr>
				<?php } ?>
            </table>
			<div id="delete_modal" class="modal">
				<span onclick="document.getElementById('delete_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
				<form class="modal-content" method = "POST" action="delete_user.php">
					<div class="modal-container">
					<h1>Delete User</h1><br>
					<p>Are you sure you want to remove this user?</p><br><br> 
					<input type="hidden" name="id" id="modal_user_id" value="">
					<div class="clearfix">
						<button type="button" class="btn cancelbtn" onclick="document.getElementById('delete_modal').style.display='none'">Cancel</button>
						<button type="submit" class="btn deletebtn" onclick="window.location.href='delete_user.php'">Delete</button>
					</div>
					</div>
				</form>
			</div>
			<?php }else{ ?>
				<h3>Empty</h3>
			<?php } ?>
		</section>
	</div>

	<script type="text/javascript">
		function openDeleteModal(userId) {
			document.getElementById('modal_user_id').value = userId;
			// Show the modal
			document.getElementById('delete_modal').style.display = 'block';
		}

		// Close modal when clicking outside of it
		window.onclick = function(event) {
			const modal = document.getElementById('delete_modal');
			if (event.target === modal) {
				modal.style.display = 'none';
			}
		}
		// Close modal with Escape key
		document.addEventListener('keydown', function(event) {
			if (event.key === 'Escape') {
				document.getElementById('delete_modal').style.display = 'none';
			}
		});


	</script>
</body>
</html>

<?php 
	}else{
		$em = "Please Login First";
        header("Location: login.php?error=$em");
        exit();
 	}
?>