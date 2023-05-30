<?php 
session_start();
include("connection.php");


if(!isset($_SESSION['username'])){

  header('location:login.php');
  
}
    $data=mysqli_query($conn,"select * from users");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>view_users</title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body>
        <div>
        <?php include_once("nav_bar.php");?>

        </div>
    <br>
    <br>
    <div class="container">
        <table border="1px">
        <thead>
            <tr>
                <th>User_id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Phone no</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; while($row = mysqli_fetch_array($data)){?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['phone_no']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                </tr>
            <?php $i++;}?>
        </tbody>
    </table>
    </div>
    </body>
</html>