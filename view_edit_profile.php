<?php
session_start();
include("connection.php");
if(!isset($_SESSION['username'])){

    header('location:login.php');
    
  }
  $result=mysqli_query($conn, "select * from users where username='".$_SESSION['username']."'");

    $row = mysqli_fetch_array($result);

    if(count($_POST)>0){
        $npassword=mysqli_real_escape_string($conn,$_POST['npassword']);
        $npassword=md5($npassword);
        mysqli_query($conn, "update users set first_name='".$_POST['first_name'] . "' ,last_name='".$_POST['last_name']."',phone_no='".$_POST['phone_no']."',email='".$_POST['email']."',password='".$npassword."' where username='". $_SESSION['username'] . "'");

         echo $message="Modified successfully";

    }
    $result2=mysqli_query($conn,"select role from users where username='".$_SESSION['username']."'");
  $row2 = mysqli_fetch_array($result2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>	
  <link rel="stylesheet" href="view.css">
</head>
<body>
  <?php include_once("nav_bar.php");?>
  <div class="container">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <label class="form_label">First Name</label><br>
            <input type="text" class="form_input" name="first_name" value="<?php echo $row["first_name"]; ?>">
            <br>
            <br>
            <label class="form_label">Last Name</label><br>
            <input type="text" class="form_input" name="last_name" value="<?php echo $row["last_name"]; ?>">
            <br>
            <br>
            <label class="form_label">Phone no</label><br>
            <input type="text" class="form_input" name="phone_no" value="<?php echo $row["phone_no"]; ?>">
            <br>
            <br>
            <label class="form_label">Email</label><br>
            <input type="text" class="form_input" name="email" value="<?php echo $row["email"]; ?>">
            <br>
            <br>
            <label class="form_label">New Password</label><br>
            <input type="password" class="form_input" name="npassword" >
            <br>
            <br>
            <input type="submit" value="Submit" class="button">
            <br>
            <br>
            <a href="admin_home.php" class="cancel">Cancel</a>
        </form>
  </div>
</body>
</html>