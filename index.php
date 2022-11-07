<?php 
include('server.php');

if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = "you need to log in first";
    header('location: login.php');
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
    <div class="header">
        <h2>Home page</h2>
    </div>

    <div class = "content">
        <?php if(isset($_SESSION['success'])) :?>
            <div class = "error success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>

            </div>
            <?php endif ?>
            <?php if (isset($_SESSION['username'])){
                $username = $_SESSION['username'];
            } 
            $userQuery = "SELECT id from users where username = '$username'";
            $usernameresult = mysqli_query($db, $userQuery);
            $rowname = mysqli_fetch_assoc($usernameresult);

            $user_id = $rowname['id'];
            
            ?>
            <?php if(isset($_SESSION['username'])) : ?>
                
                <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong> <a href="index.php?logout='1'" style = "color:red; margin-left:200px;">logout</a></p>
                
                <p style="margin-top:50px;">Total Income: <?php 
                    $sql = "SELECT sum(amount) from income where user_id = $user_id";
                    $q = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($q);

                    echo $row[0];
                
                ?> <a href= "incomepage.php" style = "margin-left: 50px;"class = "btn btn-primary">Add income</a></p>
                <p>Total Expenses: <?php 
                    $sql1 = "SELECT sum(amount) from expenses where user_id = $user_id";
                    $q1 = mysqli_query($db, $sql1);
                    $row1 = mysqli_fetch_array($q1);

                    echo $row1[0];
                
                ?> <a href= "expense.php" style = "margin-left: 50px;"class = "btn btn-primary">Add Expenses</a></p>
                <p>Current Balance: <?php echo $row[0] - $row1[0]?></p>
            <?php endif ?>
    </div>
</body>
</html>

