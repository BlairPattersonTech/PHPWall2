<?php
include('session.php');
//GET Vehicle Inventory Primary key from URL.
//!!!!!!need to come back and sanitize
$VID = $_GET[ 'VID' ];
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>AutoMall | Vehicle Information</title>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            AutoMall
        </a>

        <span class="navbar-text">
            <?php echo  $_SESSION['login_user']; ?>

            </span>
        <a href="logout.php" class="btn btn-info" role="button">Log Out</a>

    </nav>
</head>

<body>
<a href="home.php" type="button" class="btn btn-primary">Back to Inventory</a>
<div class="container">
<?php
//Query the products table for the primary key we captured on page load
//Join Product Information Table to the Products PK for even more vehicle info
$sql = 'SELECT * FROM PRODUCTS P INNER JOIN P_INFO PI on P.INV_ID = PI.INV_ID where P.INV_ID =' . $VID;
if($result = mysqli_query($db, $sql)) {
    if(mysqli_num_rows($result) > 0) { // if any rows return lets build a card
        echo '<div class="row">'; //bootstrap formatting requires this to start and end outside the loop
        while($row = mysqli_fetch_array($result)) {
            echo '<div class="col-md-10">';
            echo '<div class="card" style="width: 40rem;">';
            echo '<img class="card-img-top" src="' . $row['imgurl'] .'">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['YEAR'] . ' ' . $row['MODEL'] . ' ' . $row['TRIM'] .'</h5>';
            echo '<h6 class="card-subtitle mb-2 text-muted">' . $row['BRAND'] . '</h6>';
            echo '<p class="card-text">This vehicle is <span class="badge badge-danger">'. $row['CONDITION'] .'</span> and priced at <span class="badge badge-primary">$'. $row['PRICE'] . '</span>!';
            echo '<br><p class="card-text">FEATURES: '. $row['Features'];
            echo '<br><p class="card-text">Drivetrain: '. $row['Drivetrain'];
            echo '<br><p class="card-text">Tires: '. $row['Tires'];
            echo '<br><p class="card-text">Headlamps: '. $row['Headlamps'];
            echo '<br><p class="card-text">Fog Lamps: '. $row['Fogs'];
            //echo '<a href="vehicle.php?VID='. $row[INV_ID] . '"  class="btn btn-primary">BUY </a>';  //Use Unique ID to link
            echo '</div></div></div>';
        }
        echo '</div>';
        mysqli_free_result($result);
    } else { //catch all the things
        echo "No records matching your query were found.";
    }
} else { //conn errors
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}


?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

