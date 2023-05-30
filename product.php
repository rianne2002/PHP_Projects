<?php
    session_start();

    include("connection.php");


    if(!isset($_SESSION['username'])){

        header('location:login.php');
    
    }

    $userresult=mysqli_query($conn,"select user_id from users where username='".$_SESSION['username']."'");

    $user= mysqli_fetch_array($userresult);

    $user_id=$user[0];

    $query = "SELECT * FROM books";

    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_array($result)){

        $book_id = $row['book_id'];

        $name = $row['book_name'];

        $description = $row['description'];
        
        $image=$row['image'];

        $query = "SELECT * FROM ratings WHERE book_id = " . $book_id . " and user_id = " . $user_id;

        $bookResult = mysqli_query($conn, $query);

        $getRating = mysqli_fetch_array($bookResult);

        if(!empty($getRating)){

            $rating = $getRating['rating'];
        
          }

        $query = "SELECT ROUND(AVG(rating), 1) as numRating FROM ratings WHERE book_id=".$book_id;

        $avgresult = mysqli_query($conn, $query);

        $fetchAverage = mysqli_fetch_array($avgresult);

        $numRating = $fetchAverage['numRating'];

        if($numRating <= 0){

            $numRating = "No ratings given.";

        }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product</title>	
  <link rel="stylesheet" href="prod.css">
</head>
<body>
<?php include_once("nav_bar.php");?>
<div class="wrap">
        <h2 class="card-title"><a href="viewbook.php?book_id=<?php echo $row["book_id"]; ?>"><?php echo $name; ?></a></h2>
        <p class="card-text">
            <img width="100%" src="<?php echo $image;?>" alt="">
        </p>
        <p>Rating : <span id='numeric_rating_<?php echo $book_id; ?>'><?php echo $numRating; ?></span>  </p>              
    </div>
<?php } ?>
</body>
</html>