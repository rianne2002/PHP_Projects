<?php

    session_start();

    include("connection.php");

    if(!isset($_SESSION['username'])){

        header('location:login.php');
    
    }
    $search_error='';  
    if(isset($_POST['save'])){
    
        if(isset($_POST['search'])){
    
        $search=$_POST['search'];
    
        $result=mysqli_query($conn,"select * from users where first_name like '%$search%' or last_name like '%$search%' or phone_no like '%$search%'");
    
        }
    
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>	
    <link rel="stylesheet" href="ss.css">
</head>
<body>

    <?php include_once("nav_bar.php");?>

    <div class="container">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="search" placeholder="search for users here">
            <input class="button" type="submit" name="save" value="Submit">
        </form>
    </div>

<div>
    <br>
    <h3>Search Result</h3>
    <br>
    <table border="1px" class="center">
        <thead>
            <tr>
                <th>User_id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Phone no</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(empty($result)){

                    echo '<tr>No data found</tr>';

                }
                else{

                    $i=0; while($row = mysqli_fetch_array($result)){
            
            ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><a href="update.php?user_id=<?php echo $row["user_id"]; ?>">Edit</a></td>
            </tr>

            <?php $i++;}}?>
              
        </tbody>
    </table>
    <div>
</body>
</html>