<?php

  session_start();

  include("connection.php");


  if(!isset($_SESSION['username'])){

    header('location:login.php');
    
  }

  $result=mysqli_query($conn,"select role from users where username='".$_SESSION['username']."'");

  $row = mysqli_fetch_array($result);
  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>	
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div>
        <?php include_once("nav_bar.php");?>
    </div>
    <div class="container">
        <h2>Welcome <?php echo $_SESSION['username'];?></h2>
    </div>
</body>
</html>