<?php
    
    session_start();

    include("connection.php");

    $result=mysqli_query($conn, "select * from users where user_id='".$_GET['user_id']."'");

    $row = mysqli_fetch_array($result);

    if(count($_POST)>0){

        mysqli_query($conn, "update users set first_name='".$_POST['first_name'] . "' ,last_name='".$_POST['last_name']."',phone_no='".$_POST['phone_no']."',email='".$_POST['email']."' where user_id='". $_GET['user_id'] . "'");

         echo $message="Modified successfully";

    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>update user</title>
        <link rel="stylesheet" href="update.css">
    </head>
    <body>

<div class="container">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <label>First Name</label><br>
            <input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>">
            <br>
            <br>
            <label>Last Name</label><br>
            <input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>">
            <br>
            <br>
            <label>Phone no</label><br>
            <input type="text" name="phone_no" value="<?php echo $row["phone_no"]; ?>">
            <br>
            <br>
            <label>Email</label><br>
            <input type="text" name="email" value="<?php echo $row["email"]; ?>">
            <br>
            <br>
            <input type="submit" value="Submit" class="button">
            <br>
            <br>
            <a href="home.php" class="cancel">Cancel</a>
        </form>
</div>
    </body>
</html>