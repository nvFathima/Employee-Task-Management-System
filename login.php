

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

    <form method = "POST" action="app/login.php" class = "shadow p-4">
        <h3 class = "display-5">Login</h3>

        <?php if(isset($_GET['error'])){  ?>
            <div class="alert alert-danger" role="alert">
                <?php echo stripcslashes($_GET['error']); ?>
            </div>
        <?php }?>

        <?php if(isset($_GET['success'])){  ?>
            <div class="alert alert-success" role="alert">
                <?php echo stripcslashes($_GET['success']); ?>
            </div>
        <?php }?>
        <?php 
            // $pass = "123";
            // $pass = password_hash($pass, PASSWORD_ARGON2ID);
            // echo $pass;
        ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User name</label>
            <input type="text" class="form-control" name = "user_name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>