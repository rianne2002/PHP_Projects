<?php

    session_start();

    include("connection.php");

    if(!isset($_SESSION['username'])){

        header('location:login.php');
    
    }
    if(isset($_POST['submit'])){



    $category_dropdown=mysqli_real_escape_string($conn,$_POST['category_dropdown']);


    $sub_category_dropdown=mysqli_real_escape_string($conn,$_POST['sub_category_dropdown']);


    $result3=mysqli_query($conn,"select * from books where category_dropdown=$category_dropdown and sub_category_dropdown=$sub_category_dropdown");

    $i=0;
    while($row3 = mysqli_fetch_array($result3)){
        echo $row3['book_name'];
        echo "<br>";
        $i++;}
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>	
    <link rel="stylesheet" href="">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>
<body>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label for="CATEGORY-DROPDOWN"></label>
            <select id="category-dropdown" name="category_dropdown">
                <option value="">Select Category</option>
                <?php
                    $result = mysqli_query($conn,"SELECT * FROM categories where parent_id = 0");
                    while($row = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row["category"];?></option>
                <?php
                    }
                ?>

            </select>
            <br><br>
            <label for="SUBCATEGORY"></label>
            <select id="sub-category-dropdown" name="sub_category_dropdown">
                <option value="">Select Sub Category</option>
            </select>
            <script>
$(document).ready(function() {
$('#category-dropdown').on('change', function() {
    var category_id = this.value;
    $.ajax({
        url: "get-subcat.php",
        type: "POST",
        data: {
            category_id: category_id
        },
        cache: false,
        success: function(result){
        $("#sub-category-dropdown").html(result);
        }
        });
    });
    });
</script>
            <input type="submit" name="submit" value="submit">
        </form>


</body>
</html>