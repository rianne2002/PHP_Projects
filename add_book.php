<?php
    session_start();

    include "connection.php";

    if(isset($_POST['submit'])){

        $book_name = mysqli_real_escape_string($conn,$_POST['book_name']);
 
        $author_name=mysqli_real_escape_string($conn,$_POST['author_name']);
 
        $description=mysqli_real_escape_string($conn,$_POST['description']);

        $filename = $_FILES['image']['name'];
	
    	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
    	$extensions_arr = array("jpg","jpeg","png","gif");
 
    	if( in_array($imageFileType,$extensions_arr) ){
 
    	if(move_uploaded_file($_FILES["image"]["tmp_name"],$filename)){
    
            $insert = "INSERT into books(image) values('$filename')";

	    	if(mysqli_query($conn, $insert)){

		      echo 'Data inserted successfully';

		}}}

        $category_dropdown=mysqli_real_escape_string($conn,$_POST['category_dropdown']);

        $sub_category_dropdown=mysqli_real_escape_string($conn,$_POST['sub_category_dropdown']);

        mysqli_query($conn,"insert into books(book_name, author_name , description ,category_dropdown ,sub_category_dropdown) values('$book_name', '$author_name ', '$description', '$category_dropdown', '$sub_category_dropdown')");

    }    
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="add_book.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>
<body>
<div>
        <?php include_once("nav_bar.php");?>
</div>
<div class="container">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" method="post">
<input class="txt" type="text" id="book_name" name="book_name" placeholder="Book Name" required>
<input class="txt" type="text" id="author_name" name="author_name" placeholder="Author Name" required>         
<input class="txt" type="text" id="description" name="description" placeholder="Description">
<input type="file" id="image" name="image" placeholder="upload file">
<br><br>

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
        <br>
        <br>
        <input class="txt button" type="submit" value="submit" name="submit">

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