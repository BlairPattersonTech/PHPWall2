<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($db,$_POST['USERNAME']);
    $mypassword = mysqli_real_escape_string($db,$_POST['PASSWORD']);

    $sql = "SELECT * FROM USERS WHERE USERNAME = '$myusername' and PASSWORD = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


    $count = mysqli_num_rows($result);
    if($count == 1) { //only 1 row returned
        if($row['ROLE'] != '0') { //User role check

            $_SESSION['login_user'] = $myusername;

            header("location: home.php");
        } else {
            $error = '<div class="alert alert-danger">You dont have access to this page.</div>';
        }
    }else {
        $error = '<div class="alert alert-danger">Your Login Name or Password is invalid</div>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>AutoMall | Login</title>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            AutoMall
        </a>

    </nav>
</head>
<body>

<div class="align-content-center">
        <div class="container" >
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Please login</h2>
                <input type="text" class="form-control" name="USERNAME" placeholder="Username" required="" autofocus="" />
                <input type="password" class="form-control" name="PASSWORD" placeholder="Password" required=""/>
                    <?php echo $error; ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit" value=" Submit ">Login</button>
            </form>
        </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



