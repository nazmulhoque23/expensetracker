<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type = "text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
</head>
<body>
    <div class = "header">
        <h2>Register</h2>
    </div>

    <form method = "POST" action = "registration.php">
        <?php include('errors.php'); ?>
        <div class = "input-group">
            <label>Username</label>
            <input type="text" name = "username" value = "<?php echo $username;?>">
        </div>

        <div class = "input-group">
            <label>Email</label>
            <input type="text" name = "email" value = "<?php echo $email;?>">
        </div>

        <div class = "input-group">
            <label>Password</label>
            <input type="text" name = "password1">
        </div>

        <div class = "input-group">
            <label>Confirm Password</label>
            <input type="text" name = "password2">
        </div>

        <div class="input-group">
            <button type="submit" class = "btn" name="reg_user">Register</button>
        </div>

        <p>
            Already a member? <a href= "login.php">Log in</a>
        </p>
    </form>
</body>
</html>

