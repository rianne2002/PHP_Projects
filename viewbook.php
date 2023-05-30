<?php
    session_start();

    include("connection.php");
    
    if(!isset($_SESSION['username'])){
    
        header('location:login.php');
    
    }

    $result=mysqli_query($conn, "select * from books where book_id='".$_GET['book_id']."'");

    $row = mysqli_fetch_array($result);

    $book_id=$row['book_id'];


    $userresult=mysqli_query($conn,"select user_id from users where username='".$_SESSION['username']."'");

    $user= mysqli_fetch_array($userresult);

    $user_id=$user[0];

    if(isset($_POST['submit'])){

        $rating=mysqli_real_escape_string($conn,$_POST['rating']);

        $key=mysqli_query($conn,"SELECT * FROM ratings WHERE book_id = " . $book_id . " and user_id = " . $user_id);

        if(!empty($rating) and empty($key)){

            mysqli_query($conn,"insert into ratings(book_id, user_id , rating) values('$book_id', '$user_id ', '$rating')");

        }
        else{

            echo "You already rated the book.";
        }

    }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <?php include_once("nav_bar.php");?>
<div class="product">
    <img src="<?php echo $row['image'];?>" alt="product image" width="300" height="300">
    <div>
        <h1 class="name"><?php echo $row['book_name']; ?></h1>
        <br>
        <h2 class="name"><?php echo $row['author_name']; ?></h2>
        <br>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" accept-charset="utf-8">
            <fieldset><legend>Review This Product</legend>	
                <p>
                <label for="rating">Rating</label>
                <input type="radio" name="rating" value="5" /> 5 
                <input type="radio" name="rating" value="4" /> 4
                <input type="radio" name="rating" value="3" /> 3 
                <input type="radio" name="rating" value="2" /> 2 
                <input type="radio" name="rating" value="1" /> 1
                </p>
                <p>
                <input type="submit" name="submit" value="Submit Review">
                </p>
                <input type="hidden" name="product_type" value="actual_product_type" id="product_type">
                <input type="hidden" name="product_id" value="actual_product_id" id="product_id">
            </fieldset>
        </form>
        <br>
        <div class="description">
            <?php echo $row['description'];?>
        </div>
    </div>
</div>
</body>
</html>