<?php 
session_start();

$username = "";
$email = "";
$errors = array();

$db = mysqli_connect('sql301.epizy.com', 'epiz_32945455', 'ifxzvp9WICBI8s', 'epiz_32945455_expensetracker');

if(isset($_POST['reg_user'])) 
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    if(empty($username)){ array_push($errors, "username is required");}
    if(empty($email)){ array_push($errors, "email is required");}
    if(empty($password1)){ array_push($errors, "password is required");}
    if($password1 != $password2){ array_push($errors, "Passwords do not match");}



$user_exists_query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
$result = mysqli_query($db, $user_exists_query);
$user = mysqli_fetch_assoc($result);

if($user){
    if($user['username'] === $username){
        array_push($errors, "username already exists");
    }

    if($user['email'] === $email){
        array_push($errors, 'email already exists');
    }
}

if(count($errors) === 0){
    $password = md5($password1);

    $query = "INSERT INTO users (username, email, password) 
               VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are logged in";

    header('location:index.php');
}
}


//LOGIN system
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)){
        array_push($errors, "username is required");
    }
    if(empty($password)){
        array_push($errors, "password is required");
    }

    if(count($errors) == 0){
        $password = md5($password);
        $query = "SELECT * FROM users where username = '$username' and password = '$password'";
        $results = mysqli_query($db, $query);
        if(mysqli_num_rows($results)==1){
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "your are now logged in";
            header('location: index.php');
        }
        else{
            array_push($errors, "Incorrect username/password combination");
        }
    }
}
?>