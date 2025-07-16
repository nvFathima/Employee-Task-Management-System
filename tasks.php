<?php 
	session_start();
	if(isset($_SESSION['role']) && isset($_SESSION['id'])){ 
		include "DB_connection.php";
		include "app/Model/Task.php";

		$text = "All Task";
		if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
			$text = "Due Today";
			$tasks = get_all_tasks_due_today($conn);
			$num_task = count_tasks_due_today($conn);

		}else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
			$text = "Overdue";
			$tasks = get_all_tasks_overdue($conn);
			$num_task = count_tasks_overdue($conn);

		}else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
			$text = "No Deadline";
			$tasks = get_all_tasks_NoDeadline($conn);
			$num_task = count_tasks_NoDeadline($conn);

		}else{
			$tasks = get_all_tasks($conn);
			$num_task = count_tasks($conn);
		}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Tasks</title>
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
            <h4 class="title">All Tasks   (<?=$num_task ?>) 
				<select onchange="location = this.value;">
					<option value="tasks.php" <?= !isset($_GET['due_date']) ? 'selected' : '' ?>>All Tasks</option>
					<option value="tasks.php?due_date=Due Today" <?= (isset($_GET['due_date']) && $_GET['due_date'] == "Due Today") ? 'selected' : '' ?>>Due Today</option>
					<option value="tasks.php?due_date=Overdue" <?= (isset($_GET['due_date']) && $_GET['due_date'] == "Overdue") ? 'selected' : '' ?>>Overdue</option>
					<option value="tasks.php?due_date=No Deadline" <?= (isset($_GET['due_date']) && $_GET['due_date'] == "No Deadline") ? 'selected' : '' ?>>No Deadline</option>
				</select>

				<a href="create_tasks.php">Create Task</a>
			</h4>
			<?php if($tasks != 0){ ?>

				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
						<th>Assigned To</th>
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
						<td><?=$task['full_name'] ?></td>
						<td><?=$task['due_date'] ?></td>
						<td><?=$task['status'] ?></td>
						<td >
							<?php if ($task['status'] == "completed"){?>
								<button type="button" class = "delete-btn" onclick="openDeleteModal('<?=$task['id']?>')">
									Delete
								</button>
							<?php }else{ ?>
								<a href="edit_task.php?id=<?=$task['id']?>" class="edit-btn">Edit</a>
								<button type="button" class = "delete-btn" onclick="openDeleteModal('<?=$task['id']?>')">
									Delete
								</button>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<div id="delete_modal" class="modal">
					<span onclick="document.getElementById('delete_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
					<form class="modal-content" method = "POST" action="delete_task.php">
						<div class="modal-container">
						<h1>Delete Task</h1><br>
						<p>Are you sure you want to delete this task?</p><br><br>
						<input type="hidden" name="id" id="modal_task_id" value="">
						<div class="clearfix">
							<button type="button" class="btn cancelbtn" onclick="document.getElementById('delete_modal').style.display='none'">Cancel</button>
							<button type="submit" class="btn deletebtn" onclick="window.location.href='delete_task.php'">Delete</button>
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
		function openDeleteModal(taskId) {
			document.getElementById('modal_task_id').value = taskId;
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