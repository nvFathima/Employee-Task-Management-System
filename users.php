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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
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
						<a href="delete_user.php?id=<?=$user['id']?>" class="delete-btn">Delete</a>
					</td>
				</tr>

				<?php } ?>
            </table>
			<?php }else{ ?>
				<h3>Empty</h3>
			<?php } ?>
		</section>
	</div>

<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(2)");
    active.classList.add("active");

</script>
</body>
</html>

<?php 
	}else{
		$em = "First Login";
        header("Location: login.php?error=$em");
        exit();
 	}
?>