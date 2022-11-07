<?php 
include('server.php');
$name = "";
$amount = "";

$username = "";
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
$userQuery = "SELECT id from users where username = '$username'";
$usernameresult = mysqli_query($db, $userQuery);
$rowname = mysqli_fetch_assoc($usernameresult);

$user_id = $rowname['id'];

if(isset($_POST['expense_add']))
{
    $name = mysqli_real_escape_string($db, $_POST['expname']);
    $amount = mysqli_real_escape_string($db, $_POST['amount']);

    $query = "INSERT INTO expenses (name, amount, user_id) 
              VALUES('$name', '$amount', '$user_id')";
    mysqli_query($db, $query);
    $_SESSION['message'] = "Info added";
    header('location:expense.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href = "style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Expense add Page</title>
</head>
<body>
    <div class = "header">
        <h2>Expense add</h2>
        <a href="index.php" class = "btn btn-primary">Back</a>
    </div>

    <form method = "POST" action = "expense.php">
        
        <div class = "input-group">
            <label>Expense name</label>
            <input type="text" name = "expname" value = "<?php echo $name;?>">
        </div>

        <div class = "input-group">
            <label>Amount</label>
            <input type="text" name = "amount" value = "<?php echo $amount;?>">
        </div>

        <div class="input-group">
            <button type="submit" class = "btn" name="expense_add">Add Expenses</button>
        </div>
    </form>

    <?php $results = mysqli_query($db, "SELECT * FROM expenses where user_id = $user_id");?>
    <table class = "table table-bordered"style = "width:20%; margin-left:650px;">
        <tr>
            <th>Expense Source</th>
            <th>Amount</th>
        </tr>
        <tr>
            <?php while($row = mysqli_fetch_array($results)) { ?>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['amount']; ?> </td>
        </tr>
        <?php }?>
    </table>
</body>
</html>