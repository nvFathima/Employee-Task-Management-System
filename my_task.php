<?php 
	session_start();
	if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
		include "DB_connection.php";
		include "app/Model/Task.php";
        $id = $_SESSION['id'];
		$tasks = get_all_tasks_by_id($conn, $id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Tasks</title>
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
            <h4 class="title">My Tasks</h4>
			<?php if($tasks != 0){ ?>

				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
						<th>Due Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php $i = 0; foreach($tasks as $task){ ?>

					<tr>
						<td><?=++$i ?></td>
						<td><?=$task['title'] ?></td>
						<?php if ($task['description'] == "No description provided"){?>
							<td style="font-style: italic;color:red"><?=$task['description']?></td>
						<?php }else{ ?>
							<td><?=$task['description']?></td>
						<?php } ?>
						<td><?=$task['due_date'] ?></td>
						<td><?=$task['status'] ?></td>
						<?php if ($task['status'] == "completed"){?>
							<td > NA </td>
						<?php }else{ ?>
							<td >
								<a href="edit_task_employee.php?id=<?=$task['id']?>" class="edit-btn">Update Status</a>
							</td>
						<?php } ?>
					</tr>
					<?php } ?>
				</table>
			<?php }else{ ?>
				<h3>Empty</h3>
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