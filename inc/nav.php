<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="side-bar">
    <div class="user-p">
        <img src="img/user.png">
        <h4>@<?=$_SESSION['username']?></h4>
    </div>
    <?php

        if ($_SESSION['role'] == "employee"){
    ?>
    <!--Employee Nav Bar-->
    <ul>
        <li class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            <a href='index.php'>
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'my_task.php') ? 'active' : '' ?>">
            <a href="my_task.php">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>My Task</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'profile.php') ? 'active' : '' ?>">
            <a href="profile.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'notifications.php') ? 'active' : '' ?>">
            <a href="notifications.php">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    <?php }else{ ?>
    <!--Admin Nav Bar-->
    <ul>
        <li class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            <a href="index.php">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'users.php') ? 'active' : '' ?>">
            <a href="users.php">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Manage Users</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'create_tasks.php') ? 'active' : '' ?>">
            <a href="create_tasks.php">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>Create Task</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'tasks.php') ? 'active' : '' ?>">
            <a href="tasks.php">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>All Tasks</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'notifications.php') ? 'active' : '' ?>">
            <a href="notifications.php">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

    <?php } ?>
</nav>