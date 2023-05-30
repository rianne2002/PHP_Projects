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
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
* {
	padding: 0;
	margin: 0;
	text-decoration: none;
	list-style: none;
	box-sizing: border-box;
}
.menu-btn {
  background: linear-gradient(to right, #35ad55, #3ea59d);
   color: black;
   padding: 16px;
   font-size: 20px;
   font-weight: bolder;
   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   border: none;
}
.dropdown-menu {
   position: relative;
   display: inline-block;
}
.menu-content {
   display: none;
   position: absolute;
   background: linear-gradient(to right, #35ad55, #3ea59d);
   min-width: 160px;
   z-index: 1;
}
nav{
	background: linear-gradient(to right, #35ad55, #3ea59d);
}
.links,.links-hidden{
   display: inline-block;
   color: black;
   padding: 12px 16px;
   text-decoration: none;
   font-size: 18px;
   font-weight: bold;
}
.links-hidden{
   display: block;
}
.links{
   display: inline-block;
}
.links-hidden:hover,.links:hover {
  border-radius: 5px;
   background-color: white;
}
.dropdown-menu:hover .menu-content {
   display: block;
}
.dropdown-menu:hover .menu-btn {
   background-color: white;
}

</style>
</head>
<body>
<nav>
<a class="links" href="home.php">HOME</a>

<?php 
        if($row[0]=="admin"):
?>

<a class="links" href="create_user.php">CREATE USERS</a>
<a class="links" href="search.php">SEARCH USERS</a>
<a class="links" href="view_user.php">VIEW USERS</a>
<div class="dropdown-menu">
<button class="menu-btn">PRODUCT</button>
<div class="menu-content">
<a class="links-hidden" href="add_book.php">ADD BOOK</a>
<a class="links-hidden" href="add_category.php">ADD CATEGORY</a>
</div>
</div>
<?php 
      endif;
      ?>
      <?php
      if($row[0]=="user"):
      ?>
<a class="links" href="password_change.php">CHANGE PASSWORD</a>
<?php
      endif;
      ?>
<a class="links" href="View/Edit Profile">MY PROFILE</a>
<a class="links" href="logout.php">LOGOUT</a>
</nav>
</body>
</html>