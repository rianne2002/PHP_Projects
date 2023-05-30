<?php
session_start();
    include "connection.php";

    if(!isset($_SESSION['username'])){

        header('location:login.php');
        
      }

    if(isset($_POST['submit'])){
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        mysqli_query($conn,"insert into categories(category) values('$category')");
    }

    if(isset($_POST['sub_submit'])){
        $subcategory = mysqli_real_escape_string($conn,$_POST['subcategory']);
        $category_dropdown=mysqli_real_escape_string($conn,$_POST['category_dropdown']);
        mysqli_query($conn,"insert into categories(parent_id,category) values('$category_dropdown','$subcategory')");
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="add_category.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>
<body>
<div>
        <?php include_once("nav_bar.php");?>
</div>
<div class="container">
<div class="title">New Category</div>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="text" id="category" name="category" placeholder="Enter new category" required>
<input type="submit" value="submit" name="submit">
</form>

</div>
<div class="container">
<div class="title">New Sub Category</div>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<label for="CATEGORY-DROPDOWN">Select Corresponding Category</label>
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
<input type="text" id="subcategory" name="subcategory" placeholder="Enter new sub category" required>
<input type="submit" value="submit" name="sub_submit">
</form>
</div>

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
</body>
</html>